<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::guest();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            // 'npp' => 'required|unique:tbl_pengguna',
            // 'nama' => 'required',
            // 'penempatan' => 'required',
            // 'jabatan' => 'required',
            // 'level' => 'required',
            // 'no_hp' => 'required|numeric|unique:tbl_pengguna',
            'no_hp' => 'required|numeric|:tbl_pengguna',
            // 'email' => 'required|unique:tbl_pengguna',
            // 'foto' => 'required|mimes:png,jpeg,jpg',
            // 'password' => 'required',
            // 'confirm_password' => 'required|same:password',
        ];
    }
}
