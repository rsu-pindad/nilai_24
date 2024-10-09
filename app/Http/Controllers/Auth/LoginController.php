<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Carbon;

class LoginController extends Controller
{
    public function index()
    {
        $data = ['title' => 'Halaman Login'];

        return View::make('login', $data);
    }

    /**
     * Handle an authentication attempt.
     */
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = Validator::make($request->all(), [
            'npp'      => ['required'],
            'password' => ['required'],
        ]);

        if ($credentials->fails()) {
            return redirect()
                       ->back()
                       ->withErrors($credentials)
                       ->withInput();
        }

        if (!Auth::attempt($credentials->validated())) {
            return redirect()
                       ->back()
                       ->withErrors(['auth' => 'username atau password salah !.'])
                       ->withInput();
        }

        $request->session()->regenerate();

        $user             = User::find(Auth::id());
        $user->last_login = Carbon::now();
        $user->save();

        return redirect()->intended('profile');
    }
}
