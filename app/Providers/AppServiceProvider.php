<?php

namespace App\Providers;

use App\Models\RelasiKaryawan;
use Illuminate\Support\Arr;
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
            if ($user) {
                if ($user->level != 1) {
                    $sheet = Sheets::spreadsheet($sheet_id)->sheet('link')->range('A:I')->get() ?? [];
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

                    $daftarStaff = [];
                    $sheet_staff = Sheets::spreadsheet($sheet_id)->sheet('link')->range('D:I')->get() ?? [];
                    $header_staff = $sheet_staff->pull(0);
                    $values_staff = Sheets::collection(header: $header_staff, rows: $sheet_staff);
                    $arr_staff =  $values_staff->toArray();

                    $sheetDummy = Arr::flatten($sheet);
                    foreach($arr_staff as $key => $items){
                        $findAtasan = RelasiKaryawan::select('populate_relasi_atasan.*','populate_relasi_karyawan.*')
                        ->join('populate_relasi_atasan','populate_relasi_karyawan.id' ,'=','populate_relasi_atasan.relasi_karyawan_id')
                        ->where('populate_relasi_karyawan.npp_karyawan', $items['NPP_STAFF'])
                        ->where('populate_relasi_atasan.npp_atasan', $sheetDummy[0])
                        ->first();
                        if($findAtasan){
                            if($findAtasan['karyawan_atasan'] != ''){
                                $daftarStaff[$key]['NPP_STAFF'] = $findAtasan['npp_karyawan'];
                                $daftarStaff[$key]['LINK_MENILAI_STAFF'] = $items['LINK_MENILAI_STAFF'];
                            }    
                        }
                    }
                    $page = request()->input('page');
                    $link = request()->input('link');
                }
            }
            $view->with(['page' => $page, 'sheet' => $sheet, 'link' => $link, 'staff' => $daftarStaff ?? false]);
        });
    }
}
