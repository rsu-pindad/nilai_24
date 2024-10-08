<?php

namespace App\Livewire\Power\Sdm\Respon;

use App\Enums\Relasi;
use App\Models\RekapPenilai;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Livewire\Attributes\Locked;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\PowerGridFields;

final class RekapResponTable extends PowerGridComponent
{
    use WithExport;

    #[Locked]
    public string $tableName = 'rekap_respon_table';

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(false),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return RekapPenilai::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
                   ->add('id')
                   ->add('pool_respon_id')
                   ->add('npp_penilai')
                   ->add('npp_penilai_npp_karyawan', function ($query) {
                       return $query->identitas_penilai->npp_karyawan;
                   })
                   ->add('jabatan_penilai')
                   ->add('npp_penilai_nama_karyawan', function ($query) {
                       return $query->identitas_penilai->nama_karyawan;
                   })
                   ->add('npp_dinilai')
                   ->add('npp_dinilai_nama_karyawan', function ($query) {
                       return $query->identitas_dinilai->nama_karyawan;
                   })
                   ->add('jabatan_dinilai')
                   ->add('strategi_perencanaan_bobot_aspek')
                   ->add('strategi_pengawasan_bobot_aspek')
                   ->add('strategi_inovasi_bobot_aspek')
                   ->add('kepemimpinan_bobot_aspek')
                   ->add('membimbing_membangun_bobot_aspek')
                   ->add('pengambilan_keputusan_bobot_aspek')
                   ->add('kerjasama_bobot_aspek')
                   ->add('komunikasi_bobot_aspek')
                   ->add('absensi_bobot_aspek')
                   ->add('integritas_bobot_aspek')
                   ->add('etika_bobot_aspek')
                   ->add('goal_kinerja_bobot_aspek')
                   ->add('error_kinerja_bobot_aspek')
                   ->add('proses_dokumen_bobot_aspek')
                   ->add('proses_inisiatif_bobot_aspek')
                   ->add('proses_polapikir_bobot_aspek')
                   ->add('sum_nilai_k_bobot_aspek')
                   ->add('sum_nilai_s_bobot_aspek')
                   ->add('sum_nilai_p_bobot_aspek')
                   ->add('sum_nilai_dp3')
                   ->add('relasi')
                   ->add('relasi_label', function ($query) {
                       if (
                           Str::remove(' ', $query->jabatan_dinilai) == 'DIREKSI'
                           || Str::remove(' ', $query->jabatan_dinilai) == 'IA'
                           || Str::remove(' ', $query->jabatan_dinilai) == 'IB'
                           || Str::remove(' ', $query->jabatan_dinilai) == 'IC'
                           || Str::remove(' ', $query->jabatan_dinilai) == 'IANS'
                           || Str::remove(' ', $query->jabatan_dinilai) == 'II'
                           || Str::remove(' ', $query->jabatan_dinilai) == 'III'
                           || Str::remove(' ', $query->jabatan_dinilai) == 'IIINS'
                           || Str::remove(' ', $query->jabatan_dinilai) == 'IIII'
                           || Str::remove(' ', $query->jabatan_dinilai) == 'IV'
                           || Str::remove(' ', $query->jabatan_dinilai) == 'IVA(III)'
                           || Str::remove(' ', $query->jabatan_dinilai) == 'IVA(IIINS)'
                           || Str::remove(' ', $query->jabatan_dinilai) == 'IVA'
                       ) {
                           if ($query->relasi == 'atasan') {
                               return '60%';
                           }
                           if ($query->relasi == 'rekanan') {
                               return '20%';
                           }
                           if ($query->relasi == 'staff') {
                               return '15%';
                           }
                           if ($query->relasi == 'self') {
                               return '5%';
                           }
                       } else {
                           if ($query->relasi == 'atasan') {
                               return '65%';
                           }
                           if ($query->relasi == 'rekanan') {
                               return '25%';
                           }
                           if ($query->relasi == 'staff') {
                               return '-';
                           }
                           if ($query->relasi == 'self') {
                               return '10%';
                           }
                       }
                   })
                   ->add('npp_penilai_dinilai')
                   ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id')
                ->hidden(isHidden: true, isForceHidden: false),
            Column::make('No', 'id')
                ->index(),
            Column::make('Pool respon id', 'pool_respon_id')
                ->hidden(isHidden: true, isForceHidden: false),
            // Column::make('Npp penilai', 'npp_penilai')
            Column::make('Relasi', 'relasi')
                ->sortable(),
            Column::make('Bobot Relasi', 'relasi_label' ),
            Column::make('Npp penilai', 'npp_penilai_npp_karyawan', 'npp_penilai'),
            Column::make('Nama penilai', 'npp_penilai_nama_karyawan', 'npp_penilai'),
            Column::make('Jabatan penilai', 'jabatan_penilai'),
            Column::make('Npp dinilai', 'npp_dinilai')
                ->sortable()
                ->searchable(),
            Column::make('Nama dinilai', 'npp_dinilai_nama_karyawan', 'npp_dinilai')
                ->sortable()
                ->searchable(),
            Column::make('Jabatan dinilai', 'jabatan_dinilai')
                ->sortable()
                ->searchable(),
            Column::make('Strategi perencanaan', 'strategi_perencanaan_bobot_aspek')
                ->sortable(),
            Column::make('Strategi pengawasan', 'strategi_pengawasan_bobot_aspek')
                ->sortable(),
            Column::make('Strategi inovasi', 'strategi_inovasi_bobot_aspek')
                ->sortable(),
            Column::make('Kepemimpinan', 'kepemimpinan_bobot_aspek')
                ->sortable(),
            Column::make('Membimbing membangun', 'membimbing_membangun_bobot_aspek')
                ->sortable(),
            Column::make('Pengambilan keputusan', 'pengambilan_keputusan_bobot_aspek')
                ->sortable(),
            Column::make('Sum Kepemimpinan', 'sum_nilai_k_bobot_aspek')
                ->sortable(),
            Column::make('Kerjasama', 'kerjasama_bobot_aspek')
                ->sortable(),
            Column::make('Komunikasi', 'komunikasi_bobot_aspek')
                ->sortable(),
            Column::make('Absensi', 'absensi_bobot_aspek')
                ->sortable(),
            Column::make('Integritas', 'integritas_bobot_aspek')
                ->sortable(),
            Column::make('Etika', 'etika_bobot_aspek')
                ->sortable(),
            Column::make('Sum Perilaku', 'sum_nilai_p_bobot_aspek')
                ->sortable(),
            Column::make('Goal kinerja', 'goal_kinerja_bobot_aspek')
                ->sortable(),
            Column::make('Error kinerja', 'error_kinerja_bobot_aspek')
                ->sortable(),
            Column::make('Proses dokumen', 'proses_dokumen_bobot_aspek')
                ->sortable(),
            Column::make('Proses inisiatif', 'proses_inisiatif_bobot_aspek')
                ->sortable(),
            Column::make('Proses polapikir', 'proses_polapikir_bobot_aspek')
                ->sortable(),
            Column::make('Sum Sasaran', 'sum_nilai_s_bobot_aspek')
                ->sortable(),
            Column::make('Sum nilai dp3', 'sum_nilai_dp3')
                ->sortable()
                ->searchable(),
            Column::make('Npp penilai dinilai', 'npp_penilai_dinilai')
                ->searchable(),
            Column::make('Created at', 'created_at')
                ->sortable(),
            Column::action('Kasi')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::enumSelect('relasi', 'relasi')
                ->dataSource(Relasi::cases())
                ->optionLabel('relasi'),
            Filter::inputText('npp_penilai_npp_karyawan')
                ->placeholder('cari npp penilai')
                ->operators(['contains', 'is_not'])
                ->filterRelation('identitas_penilai', 'npp_karyawan'),
            Filter::inputText('npp_penilai_nama_karyawan')
                ->placeholder('cari nama penilai')
                ->operators(['contains', 'is_not'])
                ->filterRelation('identitas_penilai', 'nama_karyawan'),
            Filter::inputText('npp_dinilai')
                ->operators(['contains', 'is_not'])
                ->placeholder('cari npp dinilai'),
            Filter::inputText('npp_dinilai_nama_karyawan')
                ->placeholder('cari nama dinilai')
                ->operators(['contains', 'is_not'])
                ->filterRelation('identitas_dinilai', 'nama_karyawan'),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert(' . $rowId . ')');
    }

    public function actions(RekapPenilai $row): array
    {
        return [
            Button::add('Pdf')
                ->slot('<svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 17v-5h1.5a1.5 1.5 0 1 1 0 3H5m12 2v-5h2m-2 3h2M5 10V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1v6M5 19v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-1M10 3v4a1 1 0 0 1-1 1H5m6 4v5h1.375A1.627 1.627 0 0 0 14 15.375v-1.75A1.627 1.627 0 0 0 12.375 12H11Z"/>
                </svg>')
                ->tooltip('Lihat Dokumen')
                ->id()
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('lihatDokumen', ['rowId' => $row->id]),
        ];
    }

    /*
     * public function actionRules($row): array
     * {
     *    return [
     *         // Hide button edit for ID 1
     *         Rule::button('edit')
     *             ->when(fn($row) => $row->id === 1)
     *             ->hide(),
     *     ];
     * }
     */
}
