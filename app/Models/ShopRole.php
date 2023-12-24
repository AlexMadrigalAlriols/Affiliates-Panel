<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShopRole extends Model
{
    use HasFactory, SoftDeletes;

    const ROLES = ['owner', 'admin', 'staff', 'member'];

    protected $fillable = [
        'user_id',
        'shop_id',
        'role',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
        
    public function shop(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Shop::class);
    }
}
