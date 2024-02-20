<?php

namespace App\Http\Controllers;

use App\Models\AturJadwal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class ProfileController extends Controller
{
    public function index()
    {
        $data = ['title' => 'Halaman Profil'];
        $jadwal = AturJadwal::get()->last();
        $nows = Carbon::now();
        if( $nows <= $jadwal['jadwal'] AND Auth::user()->level != 1){
            return View::make('error-jadwal');
        }else{
            return View::make('profile', $data);
        }
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'nama' => 'required',
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
        $validated = $request->validate([
            'oldPassword' => 'required|min:5',
            'password' => 'required|min:5',
            'confirm_password' => 'required|min:5|same:password',
        ]);

        if (Hash::check($request->oldPassword, auth()->user()->password)) {
            $validated['password'] = Hash::make($request->password);
            $user->update($validated);
            return redirect()->back()->withToastSuccess('Berhasil ubah password');
        } else {
            return redirect()->back()->with('toast_error', 'Password lama salah');
        }
    }
}
