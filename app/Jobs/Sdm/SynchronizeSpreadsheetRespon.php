<?php

namespace App\Jobs\Sdm;

use App\Models\GResponse;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use Revolution\Google\Sheets\Facades\Sheets;

class SynchronizeSpreadsheetRespon implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $sheetId;
    protected $sheetName;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        $this->sheetId   = config('google.config.sheet_response_id', '');
        $this->sheetName = config('google.config.sheet_response_name', '');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $values = Sheets::spreadsheet($this->sheetId)->sheet($this->sheetName)->get();  // YANG BARU
            $values = array_filter($values->toArray());
            unset($values[0]);
            $timesValue = '';
            $chunks     = array_chunk($values, 50);
            foreach ($chunks as $chunk) {
                foreach ($chunk as $key => $val) {
                    $timesValue = Carbon::createFromFormat('d/m/Y H:i:s', $val[0])->format('Y-m-d H:i:s');
                    $findTime   = GResponse::where('timestamp', $timesValue)->first();
                    if (!$findTime) {
                        GResponse::updateOrCreate(
                            [
                                'timestamp' => $timesValue,
                            ],
                            [
                                'npp_penilai'           => $val[1],
                                'nama_penilai'          => $val[2],
                                'npp_dinilai'           => $val[3],
                                'nama_dinilai'          => $val[4],
                                'jabatan_dinilai'       => $val[5],
                                'strategi_perencanaan'  => $val[6],
                                'strategi_pengawasan'   => $val[7],
                                'strategi_inovasi'      => $val[8],
                                'kepemimpinan'          => $val[9],
                                'membimbing_membangun'  => $val[10],
                                'pengambilan_keputusan' => $val[11],
                                'kerjasama'             => $val[12],
                                'komunikasi'            => $val[13],
                                'absensi'               => $val[14],
                                'integritas'            => $val[15],
                                'etika'                 => $val[16],
                                'goal_kinerja'          => $val[17],
                                'error_kinerja'         => $val[18],
                                'proses_dokumen'        => $val[19],
                                'proses_inisiatif'      => $val[20],
                                'proses_polapikir'      => $val[21],
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
