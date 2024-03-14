<?php

namespace App\Http\Requests\Roles;

use App\Models\Role;
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
        $roles = Role::where('title', '!=', 'Owner')->where('type', Role::TYPES['shop'])->pluck('id')->toArray();

        return [
            'role_id' => 'required|in:' . implode(',', $roles),
            'user_id' => 'required|exists:users,id'
        ];
    }
}
