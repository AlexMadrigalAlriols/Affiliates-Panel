<?php

namespace App\Http\Requests\Shop;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDataRequest extends FormRequest
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
            'shop_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'colors' => 'required|array',
            'colors.primary' => 'required|string',
            'colors.secondary' => 'required|string',
            'colors.texts' => 'required|string',
            'colors.reward_card' => 'required|string',
            'colors.button' => 'required|string',
            'colors.button_text' => 'required|string',
        ];
    }
}
