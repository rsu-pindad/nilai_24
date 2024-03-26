<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    public function index()
    {
        $data = ['title' => 'Halaman Lupa Password'];
        return view('forgotpassword', $data);
    }

    public function send(Request $request)
    {
        $password = Str::random(10);
        $user = User::where('npp', $request->npp)->first();

        if ($user) {
            if ($user->no_hp == $request->no_hp) {

                $user->update(['password' => Hash::make($password)]);

                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://api.fonnte.com/send',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => array(
                        'target' => $request->no_hp,
                        'message' => "Password baru : $password

                        https://assessment-2024.pindadmedika.com/",
                        'countryCode' => '62', //optional
                    ),
                    CURLOPT_HTTPHEADER => array(
                        'Authorization: '.env('FONNTE_TOKEN', '') //change TOKEN to your actual token
                    ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);
                echo $response;

                return redirect()->route('login')->with('toast_success', 'Password berhasil direset!');
            } else {
                return back()->with('toast_error', 'No HP tidak sama dengan yang didaftarkan!');
            }
        }

        return back()->with('toast_error', 'NPP tidak ditemukan!');
    }
}
