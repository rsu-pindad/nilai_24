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
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index()
    {
        $data   = ['title' => 'Halaman Profil'];
        $jadwal = AturJadwal::get()->last();
        $nows   = Carbon::now();
        if ($jadwal) {
            if ($nows <= $jadwal['jadwal'] AND Auth::user()->level != 1) {
                return View::make('error-jadwal');
            } else {
                return View::make('profile', $data);
            }
        } else {
            return View::make('profile', $data);
        }
    }

    public function update(Request $request, User $user)
    {
        $validated = Validator::make($request->all(), [
            'nama'  => ['required', 'string'],
            'no_hp' => ['required', 'numeric',       Rule::unique('tbl_pengguna')->ignore($user)],
            'email' => ['required', 'email:rfc,dns', Rule::unique('tbl_pengguna')->ignore($user)],
        ]);

        if ($validated->fails()) {
            return redirect()
                       ->back()
                       ->withErrors($validated)
                       ->withInput();
        }

        $user->nama  = $validated->safe()->nama;
        $user->email = $validated->safe()->email;
        $user->no_hp = $validated->safe()->no_hp;
        $user->save();

        return redirect()->back()->with('status', 'Profil diperbarui!');
    }

    public function update_photo(Request $request, User $user)
    {
        $validated = Validator::make($request->all(), [
            'photo' => ['required', 'mimes:png,jpeg,jpg'],
        ]);

        if ($validated->fails()) {
            return redirect()
                       ->back()
                       ->withErrors($validated)
                       ->withInput();
        }
        $file = $request->file('photo');

        $name = $file->getClientOriginalName();
        // $extension = $file->getClientOriginalExtension();

        if (Storage::disk('public')->exists('photo/', $user->foto)) {
            Storage::disk('public')->delete('photo/' . $user->foto);
        }
        $file->storeAs('photo', $name, 'public');

        $user->foto = $name;
        $user->save();

        return redirect()->back()->with('status_photo', 'Foto diperbarui!');
    }

    public function update_password(Request $request, User $user)
    {
        $validated = Validator::make($request->all(), [
            'oldPassword'      => 'required|min:5',
            'password'         => 'required|min:5',
            'confirm_password' => 'required|min:5|same:password',
        ]);

        if ($validated->fails()) {
            return redirect()
                       ->back()
                       ->withErrors($validated)
                       ->withInput();
        }

        if (!Hash::check($validated->safe()->oldPassword, Auth::user()->password)) {
            return redirect()->back()->with('status_pass_fail', 'Password sekarang tidak sesuai');
        }
        $user->password = Hash::make($validated->safe()->password);
        $user->save();

        return redirect()->back()->with('status_pass', 'Password diperbarui!');
    }
}
