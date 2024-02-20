<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View as FacadesView;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;
use Revolution\Google\Sheets\Facades\Sheets;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        FacadesView::composer('*', function (View $view) {
            $user = Auth::user();
            $page = '';
            $link = '';
            $sheet = [];
            if ($user) {
                if ($user->level != 1) {
                    # code...
                    $sheet = Sheets::spreadsheet('1banzT8ab9tWTv2eqxU84tIGmnmkBxRTNwhN4o5OpQO8')->sheet('link')->get() ?? [];
                    $header = $sheet->pull(0);
                    $values = Sheets::collection(header: $header, rows: $sheet);
                    $arr =  $values->toArray();
                    $sheet = array_filter($arr, function ($var) {
                        return ($var['NPP'] == Auth::user()->npp);
                    });
                    // dd($new);
                    $page = request()->input('page');
                    $link = request()->input('link');
                    // $data = ['title' => 'Halaman Self Assesment', 'page' => $page, 'sheet' => $new, 'link' => $link];
                }
            }
            $view->with(['page' => $page, 'sheet' => $sheet, 'link' => $link]);
        });
    }
}
