<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shop extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'name',
        'type',
        'subdomain',
        'description',
        'config',
        'currency_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'config' => 'json'
    ];

    public function getDomainAttribute(): bool
    {
        return env('APP_URL') . '/' . $this->subdomain;
    }

    public function shopLevels(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ShopLevel::class);
    }

    public function shopCustomers(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class, 'users_shops', 'shop_id', 'user_id');
    }

    public function shopTicketHistory(): \Illuminate\Database\Eloquent\Relations\hasMany
    {
        return $this->hasMany(Ticket::class);
    }

    public function shopRoles(): \Illuminate\Database\Eloquent\Relations\hasMany
    {
        return $this->hasMany(ShopRole::class);
    }

    public function shopPayChecks(): \Illuminate\Database\Eloquent\Relations\hasMany
    {
        return $this->hasMany(Voucher::class);
    }

    public function shopLogs(): \Illuminate\Database\Eloquent\Relations\hasMany
    {
        return $this->hasMany(Log::class);
    }

    public function currency(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where('subdomain', $value)->firstOrFail();
    }

    public function shopMessages(): \Illuminate\Database\Eloquent\Relations\hasMany
    {
        return $this->hasMany(Message::class);
    }
}
