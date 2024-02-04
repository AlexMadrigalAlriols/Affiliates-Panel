<?php

namespace App\Models;

use App\Helpers\CurrencyHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'shop_id',
        'currency_id',
        'import',
        'created_at',
        'updated_at'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function shop(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Shop::class);
    }

    public function currency(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    // Value With Currency
    protected function valueFloat(): \Illuminate\Database\Eloquent\Casts\Attribute
    {
        return new \Illuminate\Database\Eloquent\Casts\Attribute(
            get: fn ($value) => $this->import && $this->currency
                ? CurrencyHelper::convertIntToFloat($this->import, $this->currency)
                : null
        );
    }

    protected function valueFloatRounded(): \Illuminate\Database\Eloquent\Casts\Attribute
    {
        return new \Illuminate\Database\Eloquent\Casts\Attribute(
            get: fn ($value) => $this->import && $this->currency
                ? CurrencyHelper::convertIntToFloatRounded($this->import, $this->currency)
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
            get: fn ($value) => $this->import && $this->currency
                ? CurrencyHelper::convertIntToFloatRounded($this->import, $this->currency)
                : null
        );
    }

    protected function valueHumanString(): \Illuminate\Database\Eloquent\Casts\Attribute
    {
        return new \Illuminate\Database\Eloquent\Casts\Attribute(
            get: fn ($value) => $this->import && $this->currency
                ? CurrencyHelper::displayPrice($this->import, $this->currency)
                : null
        );
    }
}
