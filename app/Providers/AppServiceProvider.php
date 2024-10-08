<?php

namespace App\Providers;

use App\Models\RelasiAtasan;
use App\Models\RelasiKaryawan;
use App\Models\RelasiSelevel;
use App\Models\RelasiStaff;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View as FacadesView;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;
use Illuminate\Support\Carbon;

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
        config(['app.locale' => 'id']);
        Carbon::setLocale('id');

        FacadesView::composer('*', function (View $view) {
            $user            = Auth::user();
            $page            = '';
            $link            = '';
            $chunk           = [];
            $sheet           = [];
            $relasi_karyawan = [];
            $relasi_atasan   = [];
            $relasi_selevel  = [];
            $relasi_staff    = [];
            $custom_data     = [];
            $sheet_id        = config('google.config.sheet_dp_2024_id', '');
            $googleFormLink  = config('google.config.sheet_response_link', '');
            if ($user) {
                if ($user->level != 1) {
                    // NEW LINK BASED ON DATABASE

                    $relasi_karyawan = RelasiKaryawan::where('npp_karyawan', Auth::user()->npp)->first();
                    $relasi_atasan   = RelasiAtasan::where('relasi_karyawan_id', $relasi_karyawan->id);
                    $relasi_selevel  = RelasiSelevel::where('relasi_karyawan_id', $relasi_karyawan->id);
                    $relasi_staff    = RelasiStaff::with(['relasi_karyawan'])->where('relasi_karyawan_id', $relasi_karyawan->id)->get();

                    // if($form_link){
                    // $form_data = $form_link->toArray();
                    $form_data = [];
                    // $form_data['form_start'] = 'https://docs.google.com/forms/d/e/1FAIpQLSfTQ2DyudZ-cGmfqWjS1Gz4fPJK33jJXIa7nOi4vVm-LYwnfA/viewform?usp=pp_url';
                    $form_data['form_start'] = $googleFormLink;
                    $form_data['form_1']     = 'entry.309041911=';
                    $form_data['form_2']     = 'entry.2024238832=';
                    $form_data['form_3']     = 'entry.1845465427=';
                    $form_data['form_4']     = 'entry.825413986=';
                    $form_data['form_5']     = 'entry.1491559044=';
                    $self                    = $relasi_karyawan->toArray();

                    // if($self['level_jabatan'])
                    $form_self = $form_data['form_start']
                        . '&' . $form_data['form_1'] . Auth::user()->npp
                        . '&' . $form_data['form_2'] . $self['nama_karyawan']
                        . '&' . $form_data['form_3'] . Auth::user()->npp
                        . '&' . $form_data['form_4'] . $self['nama_karyawan']
                        . '&' . $form_data['form_5'] . $self['level_jabatan'];

                    $atasan = $relasi_atasan->first();
                    if ($atasan) {
                        $atasan->toArray();
                        $data_atasan = RelasiKaryawan::where('npp_karyawan', $atasan['npp_atasan'])->first();
                        if ($data_atasan) {
                            $data_atasan->toArray();
                            // $full_form = $form_data['form_start'].'&'.$form_data['form_1'].'&'.$form_data['form_2'].'&'.$form_data['form_3'].'&'.$form_data['form_4'].'&'.$form_data['form_5'];
                            $atasan = json_decode($relasi_atasan->pluck('npp_atasan')->toJson());
                            $form_atasan = $form_data['form_start']
                                . '&' . $form_data['form_1'] . Auth::user()->npp
                                . '&' . $form_data['form_2'] . $self['nama_karyawan']
                                . '&' . $form_data['form_3'] . $data_atasan['npp_karyawan']
                                . '&' . $form_data['form_4'] . $data_atasan['nama_karyawan']
                                . '&' . $form_data['form_5'] . $data_atasan['level_jabatan'];
                        } else {
                            $atasan      = '';
                            $form_atasan = '#N/A';
                        }
                    }

                    $form_selevel = '#N/A';
                    $selevel      = $relasi_selevel->first();
                    if ($selevel) {
                        $selevel->toArray();
                        $data_selevel = RelasiKaryawan::where('npp_karyawan', $selevel['npp_selevel'])->first();
                        if ($data_selevel) {
                            $data_selevel->toArray();
                            $selevel = json_decode($relasi_selevel->pluck('npp_selevel')->toJson());

                            $form_selevel = $form_data['form_start']
                                . '&' . $form_data['form_1'] . Auth::user()->npp
                                . '&' . $form_data['form_2'] . $self['nama_karyawan']
                                . '&' . $form_data['form_3'] . $data_selevel['npp_karyawan']
                                . '&' . $form_data['form_4'] . $data_selevel['nama_karyawan']
                                . '&' . $form_data['form_5'] . $data_selevel['level_jabatan'];
                        } else {
                            $selevel = '';
                        }
                    }

                    $daftarStaff = [];
                    foreach ($relasi_staff as $key => $items) {
                        $data_staff = RelasiKaryawan::where('npp_karyawan', $items['npp_staff'])->first();
                        if ($data_staff) {
                            $data_staff->toArray();
                            $form_staff = $form_data['form_start']
                                . '&' . $form_data['form_1'] . Auth::user()->npp
                                . '&' . $form_data['form_2'] . $self['nama_karyawan']
                                . '&' . $form_data['form_3'] . $data_staff['npp_karyawan']
                                . '&' . $form_data['form_4'] . $data_staff['nama_karyawan']
                                . '&' . $form_data['form_5'] . $data_staff['level_jabatan'];

                            $daftarStaff[$key]['NPP_STAFF']  = $data_staff['npp_karyawan'];
                            $daftarStaff[$key]['LINK_STAFF'] = $form_staff;
                        }
                    }
                    // }else{
                    //     $form_data = $form_link;
                    // }

                    $custom_data = [
                        'NPP'       => Auth::user()->npp,
                        'LINK_SELF' => $form_self ?? '',
                    ];

                    if ($atasan != '') {
                        $data =
                            [
                                'NPP_ATASAN'  => $atasan[0],
                                'LINK_ATASAN' => $form_atasan
                            ];
                        $custom_data = $custom_data + $data;
                    }
                    if ($selevel != '') {
                        $data =
                            [
                                'NPP_SELEVEL'  => $selevel[0],
                                'LINK_SELEVEL' => $form_selevel
                            ];
                        $custom_data = $custom_data + $data;
                    }

                    $page = request()->input('page');
                    $link = request()->input('link');
                }
            }
            $view->with(['page' => $page, 'sheet' => $custom_data, 'link' => $link, 'staff_data' => $daftarStaff ?? []]);
        });
    }
}
