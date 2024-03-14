<?php

namespace App\Models;

use App\Helpers\CurrencyHelper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Voucher extends Model
{
    use HasFactory, SoftDeletes;
    const LENGTH_CODE = 9;

    protected $fillable = [
        'code',
        'shop_id',
        'user_id',
        'reward',
        'expires_at',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('notExpired', function ($query) {
            $query->whereDate('expires_at', '>=', now())
                ->orWhereNull('expires_at');
        });
    }

    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where('code', $value)->firstOrFail();
    }

    public function shop(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Shop::class);
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected function expired(): \Illuminate\Database\Eloquent\Casts\Attribute
    {
        $expirationDate = $this->expires_at !== null ? Carbon::parse($this->expires_at) : null;

        return new \Illuminate\Database\Eloquent\Casts\Attribute(
            get: fn ($value) => $expirationDate !== null
                ? $expirationDate->lt(now()) && !$expirationDate->isSameDay(now())
                : false
        );
    }

    protected function timeAgo(): \Illuminate\Database\Eloquent\Casts\Attribute
    {
        return new \Illuminate\Database\Eloquent\Casts\Attribute(
            get: fn ($value) => $this->created_at !== null
                ? $this->created_at->diffForHumans()
                : null
        );
    }

    public static function generateCode(): string
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < self::LENGTH_CODE; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $randomString;
    }
}
