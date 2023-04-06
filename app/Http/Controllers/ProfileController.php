<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index()
    {
        $data = ['title' => 'Halaman Profil'];
        return View::make('profile', $data);
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'penempatan' => 'required',
            'jabatan' => 'required',
            'level' => 'required',
            'no_hp' => ['required', Rule::unique('tbl_pengguna')->ignore($user)],
            'email' => ['required', Rule::unique('tbl_pengguna')->ignore($user)],
        ]);
        $user->update($validated);
        return redirect()->back()->withToastSuccess('Berhasil ubah data profil');
    }

    public function update_photo(Request $request, User $user)
    {
        $validated = $request->validate([
            'foto' => 'required|mimes:png,jpeg,jpg',
        ]);

        Storage::delete($user->foto);

        $path = $request->file('foto')->store('foto');
        $validated['foto'] = $path;

        $user->update($validated);

        return redirect()->back()->withToastSuccess('Berhasil ubah foto profil');
    }

    public function update_password(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:5',
            'confirm_password' => 'required|min:5|same:password',
        ]);
        $validated = $validator->validated();


        $user->update($validated);

        return redirect()->back()->withToastSuccess('Berhasil ubah password');
    }
}
