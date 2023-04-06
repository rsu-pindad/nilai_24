<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    public function index()
    {
        // Alert::toast('Your Post as been submited!', 'success');
        $data = ['title' => 'Halaman Login'];
        return View::make('login', $data);
    }

    /**
     * Handle an authentication attempt.
     */
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = Validator::make($request->all(), [
            'npp' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials->validated())) {
            $request->session()->regenerate();
            User::where('npp', $request->npp)->update(['last_login' => Carbon::now()]);
            return redirect()->intended('profile');
        }

        return back()->with('toast_error', 'username atau password salah')->withInput();
    }
}
