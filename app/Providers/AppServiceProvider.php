<?php

namespace App\Providers;

use App\Models\LinkNilai;
use App\Models\RelasiKaryawan;
use App\Models\RelasiAtasan;
use App\Models\RelasiSelevel;
use App\Models\RelasiStaff;
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
            $chunk = [];
            $sheet = [];
            $relasi_karyawan = [];
            $relasi_atasan = [];
            $relasi_selevel = [];
            $relasi_staff = [];
            $custom_data = [];
            $sheet_id = env('GOOGLE_SHEET_ID', '');
            if ($user) {
                if ($user->level != 1) {
                    // $sheet = Sheets::spreadsheet($sheet_id)->sheet('link')->range('A:I')->get() ?? [];
                    // $header = $sheet->pull(0);
                    // $values = Sheets::collection(header: $header, rows: $sheet);
                    // $arr =  $values->toArray();
                    // $sheet = array_filter($arr, function ($var) {
                    //     if($var['NPP'] == Auth::user()->npp){
                    //         return ($var['NPP']);
                    //     }else{
                    //         unset($arr);
                    //     }
                    // });

                    // $daftarStaff = [];
                    // $sheet_staff = Sheets::spreadsheet($sheet_id)->sheet('link')->range('D:I')->get() ?? [];
                    // $header_staff = $sheet_staff->pull(0);
                    // $values_staff = Sheets::collection(header: $header_staff, rows: $sheet_staff);
                    // $arr_staff =  $values_staff->toArray();

                    // $sheetDummy = Arr::flatten($sheet);
                    // foreach($arr_staff as $key => $items){
                    //     $findAtasan = RelasiKaryawan::select('populate_relasi_atasan.*','populate_relasi_karyawan.*')
                    //     ->join('populate_relasi_atasan','populate_relasi_karyawan.id' ,'=','populate_relasi_atasan.relasi_karyawan_id')
                    //     ->where('populate_relasi_karyawan.npp_karyawan', $items['NPP_STAFF'])
                    //     ->where('populate_relasi_atasan.npp_atasan', $sheetDummy[0])
                    //     ->first();
                    //     if($findAtasan){
                    //         if($findAtasan['karyawan_atasan'] != ''){
                    //             $daftarStaff[$key]['NPP_STAFF'] = $findAtasan['npp_karyawan'];
                    //             $daftarStaff[$key]['LINK_MENILAI_STAFF'] = $items['LINK_MENILAI_STAFF'];
                    //         }    
                    //     }
                    // }
                    // $page = request()->input('page');
                    // $link = request()->input('link');
                    // $chunk = Arr::first($sheet);

                    // dd($chunk);

                    // NEW LINK BASED ON DATABASE
                    
                    $form_link = LinkNilai::where('active', 1)->first();
                    $relasi_karyawan = RelasiKaryawan::where('npp_karyawan', Auth::user()->npp)->first();
                    $relasi_atasan = RelasiAtasan::where('relasi_karyawan_id', $relasi_karyawan->id);
                    $relasi_selevel = RelasiSelevel::where('relasi_karyawan_id', $relasi_karyawan->id);
                    $relasi_staff = RelasiStaff::with(['relasi_karyawan'])->where('relasi_karyawan_id', $relasi_karyawan->id)->get();
                    
                    if($form_link){
                        $form_data = $form_link->toArray();
                        $self = $relasi_karyawan->toArray();

                        // if($self['level_jabatan'])
                        $form_self = $form_data['form_start'].
                        '&'.$form_data['form_1'].Auth::user()->npp.
                        '&'.$form_data['form_2'].$self['nama_karyawan'].
                        '&'.$form_data['form_3'].Auth::user()->npp.
                        '&'.$form_data['form_4'].$self['nama_karyawan'].
                        '&'.$form_data['form_5'].$self['level_jabatan'];
                        
                        $atasan = $relasi_atasan->first()->toArray();
                        $data_atasan = RelasiKaryawan::where('npp_karyawan', $atasan['npp_atasan'])->first()->toArray();
                        // $full_form = $form_data['form_start'].'&'.$form_data['form_1'].'&'.$form_data['form_2'].'&'.$form_data['form_3'].'&'.$form_data['form_4'].'&'.$form_data['form_5'];
                        $atasan = json_decode($relasi_atasan->pluck('npp_atasan')->toJson());
                        $form_atasan = $form_data['form_start'].
                        '&'.$form_data['form_1'].Auth::user()->npp.
                        '&'.$form_data['form_2'].$self['nama_karyawan'].
                        '&'.$form_data['form_3'].$data_atasan['npp_karyawan'].
                        '&'.$form_data['form_4'].$data_atasan['nama_karyawan'].
                        '&'.$form_data['form_5'].$data_atasan['level_jabatan'];
                        
                        $form_selevel = '#N/A';
                        $selevel = $relasi_selevel->first();
                        if($selevel){
                            $selevel->toArray();
                            $data_selevel = RelasiKaryawan::where('npp_karyawan', $selevel['npp_selevel'])->first()->toArray();
                            $selevel = json_decode($relasi_selevel->pluck('npp_selevel')->toJson());

                            $form_selevel = $form_data['form_start'].
                            '&'.$form_data['form_1'].Auth::user()->npp.
                            '&'.$form_data['form_2'].$self['nama_karyawan'].
                            '&'.$form_data['form_3'].$data_selevel['npp_karyawan'].
                            '&'.$form_data['form_4'].$data_selevel['nama_karyawan'].
                            '&'.$form_data['form_5'].$data_selevel['level_jabatan'];
                        }
                        

                        $daftarStaff = [];
                        foreach($relasi_staff as $key => $items){
                            $data_staff = RelasiKaryawan::where('npp_karyawan', $items['npp_staff'])->first();
                            if($data_staff){
                                $data_staff->toArray();
                                $form_selevel = $form_data['form_start'].
                                '&'.$form_data['form_1'].Auth::user()->npp.
                                '&'.$form_data['form_2'].$self['nama_karyawan'].
                                '&'.$form_data['form_3'].$data_staff['npp_karyawan'].
                                '&'.$form_data['form_4'].$data_staff['nama_karyawan'].
                                '&'.$form_data['form_5'].$data_staff['level_jabatan'];

                                $daftarStaff[$key]['NPP_STAFF'] = $data_staff['npp_karyawan'];
                                $daftarStaff[$key]['LINK_STAFF'] = $form_selevel;
                            }
                        }
                    }else{
                        $form_data = $form_link;
                    }

                    $custom_data = [
                        'NPP' => Auth::user()->npp,
                        'NPP_ATASAN' => $atasan[0] ?? [],
                        'NPP_SELEVEL' => $selevel[0] ?? [],
                        'LINK_SELF' => $form_self ?? [],
                        'LINK_ATASAN' => $form_atasan ?? [],
                        'LINK_SELEVEL' => $form_selevel ?? [],
                    ];
                    
                    $page = request()->input('page');
                    $link = request()->input('link');
                    // dd($custom_data);
                }
            }
            $view->with(['page' => $page, 'sheet' => $custom_data, 'link' => $link, 'staff_data' => $daftarStaff ?? []]);
            // $view->with(['page' => $page, 'sheet' => $chunk, 'link' => $link, 'staff' => $daftarStaff ?? false]);
            // $view->with([
            //     'page' => $page, 
            //     'link' => $link, 
            //     'form' => $form_link,
            //     'self' => $relasi_karyawan,
            //     'atasan' => $relasi_atasan ?? false,
            //     'selevel' => $relasi_selevel ?? false,
            //     'staff' => $relasi_staff ?? false,
            // ]);
        });
    }
}
