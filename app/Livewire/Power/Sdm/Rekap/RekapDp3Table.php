<?php

namespace App\Livewire\Power\Sdm\Rekap;

use App\Models\RekapDp3;
use App\Models\RelasiKaryawan;
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

final class RekapDp3Table extends PowerGridComponent
{
    use WithExport;

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export_rekap_dp3_')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSoftDeletes(false)->showSearchInput(),
            Footer::make()
                ->pageName('personalPage')
                ->showPerPage(perPage: 25, perPageValues: [25, 50, 100, 250])
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return RekapDp3::query()->groupBy('dinilai_id');
    }

    public function relationSearch(): array
    {
        return [
            'belongsDinilaiRelasiKaryawan' => [
                'id',
                'nama_karyawan',
            ],
        ];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
                   ->add('id')
                   ->add('dinilai_id')
                   ->add('dinilai_id_label', function ($query) {
                       return $query->identitas_dinilai->nama_karyawan;
                   })
                   ->add('level_jabatan', function ($query) {
                       return $query->identitas_dinilai->level_jabatan;
                   })
                   ->add('unit_jabatan', function ($query) {
                       return $query->identitas_dinilai->unit_jabatan;
                   })
                   ->add('created_at')
                   ->add('created_at_formatted', function ($query) {
                       return Carbon::parse($query->created_at)->translatedFormat('d F Y');
                   });
    }

    public function columns(): array
    {
        return [
            Column::make('No', 'id')
                ->index(),
            Column::make('Id', 'id')
                ->hidden(isHidden: true, isForceHidden: false),
            Column::make('Dokumen', 'dinilai_id_label', 'dinilai_id'),
            Column::make('Level', 'level_jabatan'),
            Column::make('Unit', 'unit_jabatan'),
            Column::make('dibuat', 'created_at_formatted', 'created_at')
                ->sortable(),
            Column::action('Aksi')
        ];
    }

    public function filters(): array
    {
        return [];
    }

    public function actions(RekapDp3 $row): array
    {
        return [
            Button::add('Personal')
                ->slot('<svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 17v-5h1.5a1.5 1.5 0 1 1 0 3H5m12 2v-5h2m-2 3h2M5 10V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1v6M5 19v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-1M10 3v4a1 1 0 0 1-1 1H5m6 4v5h1.375A1.627 1.627 0 0 0 14 15.375v-1.75A1.627 1.627 0 0 0 12.375 12H11Z"/>
                </svg>')
                ->id()
                ->tooltip('Lihat Dokumen Personal')
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('lihatPersonal', ['dinilaiId' => $row->dinilai_id])
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
