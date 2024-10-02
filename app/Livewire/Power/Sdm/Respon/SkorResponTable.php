<?php

namespace App\Livewire\Power\Sdm\Respon;

use App\Enums\Relasi;
use App\Models\PoolRespon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
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

final class SkorResponTable extends PowerGridComponent
{
    use WithExport;

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSoftDeletes(true),
            Footer::make()
                ->pageName('skorResponTabel')
                ->showPerPage(perPage: 25, perPageValues: [25, 50, 100, 500])
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return PoolRespon::query();
    }

    public function relationSearch(): array
    {
        return [
            // 'npp_penilai' => [
            //     'npp_karyawan',
            // ]
        ];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
                   ->add('id')
                   ->add('npp_penilai')
                   ->add('npp_penilai_npp_karyawan', function ($query) {
                       return $query->karyawan->npp_karyawan;
                   })
                   ->add('npp_penilai_nama_karyawan', function ($query) {
                       return $query->karyawan->nama_karyawan;
                   })
                   ->add('npp_penilai_jabatan_karyawan', function ($query) {
                       return $query->karyawan->level_jabatan;
                   })
                   ->add('npp_dinilai')
                   ->add('npp_dinilai_nama_karyawan', function ($query) {
                       return $query->karyawan_dinilai->nama_karyawan;
                   })
                   ->add('jabatan_dinilai')
                   ->add('strategi_perencanaan')
                   ->add('strategi_pengawasan')
                   ->add('strategi_inovasi')
                   ->add('kepemimpinan')
                   ->add('membimbing_membangun')
                   ->add('pengambilan_keputusan')
                   ->add('kerjasama')
                   ->add('komunikasi')
                   ->add('absensi')
                   ->add('integritas')
                   ->add('etika')
                   ->add('goal_kinerja')
                   ->add('error_kinerja')
                   ->add('proses_dokumen')
                   ->add('proses_inisiatif')
                   ->add('proses_polapikir')
                   ->add('sum_nilai')
                   ->add('relasi')
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
            Column::make('Relasi Sebagai', 'relasi')
                ->sortable(),
            Column::make('Npp penilai', 'npp_penilai_npp_karyawan', 'id'),
            Column::make('Nama penilai', 'npp_penilai_nama_karyawan', 'id'),
            Column::make('Jabatan penilai', 'npp_penilai_jabatan_karyawan', 'id'),
            Column::make('Npp dinilai', 'npp_dinilai')
                ->searchable(),
            Column::make('Nama dinilai', 'npp_dinilai_nama_karyawan','id')
                ->searchable(),
            Column::make('Jabatan dinilai', 'jabatan_dinilai')
                ->sortable()
                ->searchable(),
            Column::make('Sum nilai', 'sum_nilai')
                ->sortable(),
            Column::make('Strategi perencanaan', 'strategi_perencanaan')
                ->sortable(),
            Column::make('Strategi pengawasan', 'strategi_pengawasan')
                ->sortable(),
            Column::make('Strategi inovasi', 'strategi_inovasi')
                ->sortable(),
            Column::make('Kepemimpinan', 'kepemimpinan')
                ->sortable(),
            Column::make('Membimbing membangun', 'membimbing_membangun')
                ->sortable(),
            Column::make('Pengambilan keputusan', 'pengambilan_keputusan')
                ->sortable(),
            Column::make('Kerjasama', 'kerjasama')
                ->sortable(),
            Column::make('Komunikasi', 'komunikasi')
                ->sortable(),
            Column::make('Absensi', 'absensi')
                ->sortable(),
            Column::make('Integritas', 'integritas')
                ->sortable(),
            Column::make('Etika', 'etika')
                ->sortable(),
            Column::make('Goal kinerja', 'goal_kinerja')
                ->sortable(),
            Column::make('Error kinerja', 'error_kinerja')
                ->sortable(),
            Column::make('Proses dokumen', 'proses_dokumen')
                ->sortable(),
            Column::make('Proses inisiatif', 'proses_inisiatif')
                ->sortable(),
            Column::make('Proses polapikir', 'proses_polapikir')
                ->sortable(),
            Column::make('Npp penilai dinilai', 'npp_penilai_dinilai'),
            Column::make('Created at', 'created_at')
                ->sortable(),
            Column::action('Aksi')
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
                ->filterRelation('karyawan', 'npp_karyawan'),
            Filter::inputText('npp_penilai_nama_karyawan')
                ->placeholder('cari nama penilai')
                ->operators(['contains', 'is_not'])
                ->filterRelation('karyawan', 'nama_karyawan'),
            Filter::inputText('npp_dinilai')
                ->operators(['contains', 'is_not'])
                ->placeholder('cari npp dinilai'),
            Filter::inputText('npp_dinilai_nama_karyawan')
                ->placeholder('cari nama dinilai')
                ->operators(['contains', 'is_not'])
                ->filterRelation('karyawan_dinilai', 'nama_karyawan'),
        ];
    }

    public function actions(PoolRespon $row): array
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
