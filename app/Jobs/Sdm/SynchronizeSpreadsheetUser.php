<?php

namespace App\Jobs\Sdm;

use App\Models\RelasiAtasan;
use App\Models\RelasiKaryawan;
use App\Models\RelasiSelevel;
use App\Models\RelasiStaff;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Revolution\Google\Sheets\Facades\Sheets;

class SynchronizeSpreadsheetUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $sheetId;
    protected $sheetName;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        $this->sheetId   = config('google.config.sheet_dp_2023_id', '');
        $this->sheetName = config('google.config.sheet_dp_2023_name', '');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $rows            = Sheets::spreadsheet($this->sheetId)->sheet($this->sheetName)->range('C$3:I')->get();
            $values          = $rows->filter();
            $lastNppKaryawan = '';
            $rkid            = '';
            $findIdRk        = '';
            foreach ($values as $key => $val) {
                if ($val[3] != '' && $val[3] != '-') {
                    $checkTable = RelasiKaryawan::where('npp_karyawan', $val[3])->first() ?? '';
                    if ($checkTable == '') {
                        $storeRk = RelasiKaryawan::updateOrCreate(
                            [
                                'npp_karyawan' => $val[3],
                            ],
                            [
                                'level_jabatan' => $val[1],
                                'unit_jabatan'  => $val[2],
                                'nama_karyawan' => $val[0],
                            ]
                        );
                        $rkid = $storeRk->id;
                    } else {
                        $findIdRk = RelasiKaryawan::where('npp_karyawan', $val[3])->first();  // dapatkan id rk
                        $rkid     = $findIdRk->id;
                    }
                    $lastNppKaryawan = $val[3];
                } else {
                    $val[3]     = $lastNppKaryawan;
                    $checkTable = RelasiKaryawan::where('npp_karyawan', $val[3])->first() ?? '';
                    if ($checkTable == '') {
                        $storeRk = RelasiKaryawan::create(
                            [
                                'npp_karyawan'  => $val[3],
                                'level_jabatan' => $val[1],
                                'unit_jabatan'  => $val[2],
                                'nama_karyawan' => $val[0],
                            ]
                        );                                                                    // Insert
                        $rkid = $storeRk->id;
                    } else {
                        $findIdRk = RelasiKaryawan::where('npp_karyawan', $val[3])->first();  // dapatkan id rk
                        $rkid     = $findIdRk->id;
                        // Dapatkan Id
                    }
                }
                // Dapatkan Id

                // Insert ke tabel relasi atasan
                if (!empty($val[4])) {
                    if ($val[4] != '') {
                        RelasiAtasan::updateOrCreate(
                            [
                                'relasi_karyawan_id' => $rkid,
                            ],
                            [
                                'npp_atasan' => $val[4],
                            ]
                        );
                    }
                }
                // Insert ke tabel relasi selevel
                if (!empty($val[5])) {
                    if ($val[5] != '') {
                        RelasiSelevel::updateOrCreate(
                            [
                                'relasi_karyawan_id' => $rkid,
                            ],
                            [
                                'npp_selevel' => $val[5],
                            ]
                        );
                    }
                }
                // Insert ke tabel relasi staff
                if (!empty($val[6])) {
                    $staff = preg_replace('/[^a-zA-Z 0-9]+/', '', $val[6]);
                    if ($staff != '') {
                        RelasiStaff::updateOrCreate(
                            [
                                'relasi_karyawan_id' => $rkid,
                                'npp_staff'          => $staff,
                            ]
                        );
                    }
                }
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            throw $exception;
        }
    }
}
