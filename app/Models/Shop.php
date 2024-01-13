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
        'subdomain',
        'config',
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

    public function shopLevels(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(ShopLevel::class);
    }

    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where('subdomain', $value)->firstOrFail();
    }
}
