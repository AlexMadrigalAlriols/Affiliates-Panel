<?php

namespace App\Models;

use App\Helpers\CurrencyHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PayCheck extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'shop_id',
        'user_id',
        'import',
        'expires_at',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'expires_at',
        'deleted_at',
    ];

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
        return new \Illuminate\Database\Eloquent\Casts\Attribute(
            get: fn ($value) => $this->expires_at !== null
                ? $this->expires_at < now()
                : false
        );
    }

    // Value With Currency
    protected function valueFloat(): \Illuminate\Database\Eloquent\Casts\Attribute
    {
        return new \Illuminate\Database\Eloquent\Casts\Attribute(
            get: fn ($value) => $this->import && $this->shop->currency
                ? CurrencyHelper::convertIntToFloat($this->import, $this->shop->currency)
                : null
        );
    }

    protected function valueFloatRounded(): \Illuminate\Database\Eloquent\Casts\Attribute
    {
        return new \Illuminate\Database\Eloquent\Casts\Attribute(
            get: fn ($value) => $this->import && $this->shop->currency
                ? CurrencyHelper::convertIntToFloatRounded($this->import, $this->shop->currency)
                : null
        );
    }

    protected function valueString(): \Illuminate\Database\Eloquent\Casts\Attribute
    {
        return new \Illuminate\Database\Eloquent\Casts\Attribute(
            get: fn ($value) => $this->import && $this->currency
                ? CurrencyHelper::displayPrice($this->import, $this->currency)
                : null
        );
    }

    protected function valueHuman(): \Illuminate\Database\Eloquent\Casts\Attribute
    {
        return new \Illuminate\Database\Eloquent\Casts\Attribute(
            get: fn ($value) => $this->import && $this->currency
                ? CurrencyHelper::convertIntToFloat($this->import, $this->currency)
                : null
        );
    }

    protected function valueHumanRounded(): \Illuminate\Database\Eloquent\Casts\Attribute
    {
        return new \Illuminate\Database\Eloquent\Casts\Attribute(
            get: fn ($value) => $this->import && $this->shop->currency
                ? CurrencyHelper::convertIntToFloatRounded($this->import, $this->shop->currency)
                : null
        );
    }

    protected function valueHumanString(): \Illuminate\Database\Eloquent\Casts\Attribute
    {
        return new \Illuminate\Database\Eloquent\Casts\Attribute(
            get: fn ($value) => $this->import && $this->shop->currency
                ? CurrencyHelper::displayPrice($this->import, $this->shop->currency)
                : null
        );
    }
}
