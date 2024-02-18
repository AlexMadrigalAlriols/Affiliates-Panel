<?php

namespace App\Http\Requests\ShopLevel;

use App\Models\ShopLevel;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return !is_null($this->shop->id);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'type' => 'required|in:' . implode(',', ShopLevel::TYPES),
            'required_exp' => 'integer',
            'point_multiplier' => 'integer',
            'rewards' => [
                'array',
                Rule::requiredIf(function () {
                    return $this->shop->type === ShopLevel::TYPES['level'];
                })
            ],
            'rewards.*' => [
                'string',
                'max:255',
                Rule::requiredIf(function () {
                    return $this->shop->type === ShopLevel::TYPES['level'];
                })
            ],
            'loop_icon' => [
                'string',
                'max:255',
                Rule::requiredIf(function () {
                    return $this->shop->type === ShopLevel::TYPES['loop'];
                })
            ],
            'loop_reward' => [
                'string',
                'max:255',
                Rule::requiredIf(function () {
                    return $this->shop->type === ShopLevel::TYPES['loop'];
                })
            ],
            'times_for_reward' => [
                'integer',
                Rule::requiredIf(function () {
                    return $this->shop->type === ShopLevel::TYPES['loop'];
                })
            ],
        ];
    }
}
