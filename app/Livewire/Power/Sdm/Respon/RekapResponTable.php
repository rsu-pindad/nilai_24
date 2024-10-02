<?php

namespace App\Livewire\Power\Sdm\Respon;

use App\Models\RekapPenilai;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
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
                           Str::remove(' ', $query->jabatan_penilai) == 'DIREKSI'
                           || Str::remove(' ', $query->jabatan_penilai) == 'IA'
                           || Str::remove(' ', $query->jabatan_penilai) == 'IB'
                           || Str::remove(' ', $query->jabatan_penilai) == 'IC'
                           || Str::remove(' ', $query->jabatan_penilai) == 'IANS'
                           || Str::remove(' ', $query->jabatan_penilai) == 'III'
                           || Str::remove(' ', $query->jabatan_penilai) == 'IIINS'
                           || Str::remove(' ', $query->jabatan_penilai) == 'IIII'
                           || Str::remove(' ', $query->jabatan_penilai) == 'IV'
                           || Str::remove(' ', $query->jabatan_penilai) == 'IVA(III)'
                           || Str::remove(' ', $query->jabatan_penilai) == 'IVA(IIINS)'
                           || Str::remove(' ', $query->jabatan_penilai) == 'IVA'
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
            Column::make('Id', 'id'),
            Column::make('Pool respon id', 'pool_respon_id'),
            // Column::make('Npp penilai', 'npp_penilai')
            //     ->hidden(isHidden: true, isForceHidden: false),
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
            Column::make('Strategi perencanaan bobot aspek', 'strategi_perencanaan_bobot_aspek')
                ->sortable()
                ->searchable(),
            Column::make('Strategi pengawasan bobot aspek', 'strategi_pengawasan_bobot_aspek')
                ->sortable()
                ->searchable(),
            Column::make('Strategi inovasi bobot aspek', 'strategi_inovasi_bobot_aspek')
                ->sortable()
                ->searchable(),
            Column::make('Kepemimpinan bobot aspek', 'kepemimpinan_bobot_aspek')
                ->sortable()
                ->searchable(),
            Column::make('Membimbing membangun bobot aspek', 'membimbing_membangun_bobot_aspek')
                ->sortable()
                ->searchable(),
            Column::make('Pengambilan keputusan bobot aspek', 'pengambilan_keputusan_bobot_aspek')
                ->sortable()
                ->searchable(),
            Column::make('Kerjasama bobot aspek', 'kerjasama_bobot_aspek')
                ->sortable()
                ->searchable(),
            Column::make('Komunikasi bobot aspek', 'komunikasi_bobot_aspek')
                ->sortable()
                ->searchable(),
            Column::make('Absensi bobot aspek', 'absensi_bobot_aspek')
                ->sortable()
                ->searchable(),
            Column::make('Integritas bobot aspek', 'integritas_bobot_aspek')
                ->sortable()
                ->searchable(),
            Column::make('Etika bobot aspek', 'etika_bobot_aspek')
                ->sortable()
                ->searchable(),
            Column::make('Goal kinerja bobot aspek', 'goal_kinerja_bobot_aspek')
                ->sortable()
                ->searchable(),
            Column::make('Error kinerja bobot aspek', 'error_kinerja_bobot_aspek')
                ->sortable()
                ->searchable(),
            Column::make('Proses dokumen bobot aspek', 'proses_dokumen_bobot_aspek')
                ->sortable()
                ->searchable(),
            Column::make('Proses inisiatif bobot aspek', 'proses_inisiatif_bobot_aspek')
                ->sortable()
                ->searchable(),
            Column::make('Proses polapikir bobot aspek', 'proses_polapikir_bobot_aspek')
                ->sortable()
                ->searchable(),
            Column::make('Sum nilai k bobot aspek', 'sum_nilai_k_bobot_aspek')
                ->sortable()
                ->searchable(),
            Column::make('Sum nilai s bobot aspek', 'sum_nilai_s_bobot_aspek')
                ->sortable()
                ->searchable(),
            Column::make('Sum nilai p bobot aspek', 'sum_nilai_p_bobot_aspek')
                ->sortable()
                ->searchable(),
            Column::make('Sum nilai dp3', 'sum_nilai_dp3')
                ->sortable()
                ->searchable(),
            Column::make('Relasi', 'relasi')
                ->sortable()
                ->searchable(),
            Column::make('Bobot Relasi', 'relasi_label', 'relasi')
                ->sortable()
                ->searchable(),
            Column::make('Npp penilai dinilai', 'npp_penilai_dinilai')
                ->sortable()
                ->searchable(),
            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->sortable(),
            Column::make('Created at', 'created_at')
                ->sortable()
                ->searchable(),
            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
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
            Button::add('edit')
                ->slot('Edit: ' . $row->id)
                ->id()
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('edit', ['rowId' => $row->id])
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
