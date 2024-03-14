<?php

namespace App\Http\Requests\Shop;

use Illuminate\Foundation\Http\FormRequest;

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
            'name' => 'required|string',
            'subdomain' => 'required|string|unique:shops,subdomain,'. $this->shop->id .',id,deleted_at,NULL',
            'description' => 'string|nullable|max:255',
            'currency_id' => 'required|exists:currencies,id',
            'shop_banner' => 'nullable|image|mimes:jpg,png,jpg,svg|max:2048'
        ];
    }
}
