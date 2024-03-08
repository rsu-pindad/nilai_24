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
            $sheet_id = env('GOOGLE_SHEET_ID', '');
            $mergeSheet = [];
            if ($user) {
                if ($user->level != 1) {
                    $sheet = Sheets::spreadsheet($sheet_id)->sheet('link')->get() ?? [];
                    $header = $sheet->pull(0);
                    $values = Sheets::collection(header: $header, rows: $sheet);
                    $arr =  $values->toArray();
                    $sheet = array_filter($arr, function ($var) {
                        if($var['NPP'] == Auth::user()->npp){
                            return ($var['NPP']);
                        }else{
                            unset($arr);
                        }
                    });
                    $mergeSheet = array_merge($sheet);
                    unset($sheet);
                    $page = request()->input('page');
                    $link = request()->input('link');
                }
            }
            $view->with(['page' => $page, 'sheet' => $mergeSheet, 'link' => $link]);
        });
    }
}
