<?php

namespace App\Http\Requests\Roles;

use App\Models\ShopRole;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'role' => 'required|in:' . implode(',', ShopRole::ROLES),
            'user_id' => 'required|exists:users,id'
        ];
    }
}
