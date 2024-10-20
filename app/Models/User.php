<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use PhpParser\Node\Stmt\Static_;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;
    const LENGTH_CODE = 6;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'code',
        'profile_img',
        'email',
        'password',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Define virtual attribute to use as fullName
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getIsAdminAttribute(): bool
    {
        return $this->roles()->where('id', 1)->exists();
    }

    public function roles(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    public function shopRoles(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ShopRole::class);
    }

    public function owned_shops(): \Illuminate\Database\Eloquent\Relations\hasManyThrough
    {
        return $this->hasManyThrough(Shop::class, ShopRole::class, 'user_id', 'id', 'id', 'shop_id')
            ->whereNotNull('shop_roles.role_id');
    }

    public function shops(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Shop::class, 'users_shops', 'user_id', 'shop_id')->where('active', 1);
    }

    public function vouchers(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Voucher::class);
    }

    public function getLevelOnShop(Shop $shop)
    {
        $user_level = UserLevel::where('user_id', $this->id)
            ->where('type', ShopLevel::TYPES['level'])
            ->where('shop_id', $shop->id)
            ->first();

        return $user_level ? $user_level->shopLevel->level : 0;
    }

    public function getRewardsCollected(Shop $shop)
    {
        $user_level = UserLevel::where('user_id', $this->id)
            ->where('type', ShopLevel::TYPES['loop'])
            ->where('shop_id', $shop->id)
            ->first();

        return $user_level ? $user_level->exp_progress : 0;
    }

    public function getTimesRewardCollected(Shop $shop)
    {
        $user_level = UserLevel::where('user_id', $this->id)
            ->where('type', ShopLevel::TYPES['loop'])
            ->where('shop_id', $shop->id)
            ->first();

        return $user_level ? ($user_level->data['times_collected'] ?? 0) : 0;
    }

    public function getProgressBar(Shop $shop)
    {
        $user_level = UserLevel::where('user_id', $this->id)
            ->where('type', ShopLevel::TYPES['level'])
            ->where('shop_id', $shop->id)
            ->first();

        if($user_level) {
            $expProgress = $user_level->exp_progress ?? 0;
            $shopLevel = $user_level->shopLevel?->level ?? 1;
            $expRequired = $shop['required_exp'] ?? config('levels.default_required_exp');

            $percentage = ($expProgress / ($shopLevel * $expRequired)) * 100;
        }

        return $percentage ?? 0;
    }

    public static function generateCode()
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < self::LENGTH_CODE; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $randomString;
    }
}
