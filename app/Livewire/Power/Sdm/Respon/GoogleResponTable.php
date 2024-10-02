<?php

namespace App\Livewire\Power\Sdm\Respon;

use App\Models\GResponse;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class GoogleResponTable extends PowerGridComponent
{
    use WithExport;

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return GResponse::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('timestamp')
            ->add('npp_penilai')
            ->add('nama_penilai')
            ->add('npp_dinilai')
            ->add('nama_dinilai')
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
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Timestamp', 'timestamp_formatted', 'timestamp')
                ->sortable(),

            Column::make('Timestamp', 'timestamp')
                ->sortable()
                ->searchable(),

            Column::make('Npp penilai', 'npp_penilai')
                ->sortable()
                ->searchable(),

            Column::make('Nama penilai', 'nama_penilai')
                ->sortable()
                ->searchable(),

            Column::make('Npp dinilai', 'npp_dinilai')
                ->sortable()
                ->searchable(),

            Column::make('Nama dinilai', 'nama_dinilai')
                ->sortable()
                ->searchable(),

            Column::make('Jabatan dinilai', 'jabatan_dinilai')
                ->sortable()
                ->searchable(),

            Column::make('Strategi perencanaan', 'strategi_perencanaan')
                ->sortable()
                ->searchable(),

            Column::make('Strategi pengawasan', 'strategi_pengawasan')
                ->sortable()
                ->searchable(),

            Column::make('Strategi inovasi', 'strategi_inovasi')
                ->sortable()
                ->searchable(),

            Column::make('Kepemimpinan', 'kepemimpinan')
                ->sortable()
                ->searchable(),

            Column::make('Membimbing membangun', 'membimbing_membangun')
                ->sortable()
                ->searchable(),

            Column::make('Pengambilan keputusan', 'pengambilan_keputusan')
                ->sortable()
                ->searchable(),

            Column::make('Kerjasama', 'kerjasama')
                ->sortable()
                ->searchable(),

            Column::make('Komunikasi', 'komunikasi')
                ->sortable()
                ->searchable(),

            Column::make('Absensi', 'absensi')
                ->sortable()
                ->searchable(),

            Column::make('Integritas', 'integritas')
                ->sortable()
                ->searchable(),

            Column::make('Etika', 'etika')
                ->sortable()
                ->searchable(),

            Column::make('Goal kinerja', 'goal_kinerja')
                ->sortable()
                ->searchable(),

            Column::make('Error kinerja', 'error_kinerja')
                ->sortable()
                ->searchable(),

            Column::make('Proses dokumen', 'proses_dokumen')
                ->sortable()
                ->searchable(),

            Column::make('Proses inisiatif', 'proses_inisiatif')
                ->sortable()
                ->searchable(),

            Column::make('Proses polapikir', 'proses_polapikir')
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
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert('.$rowId.')');
    }

    public function actions(GResponse $row): array
    {
        return [
            Button::add('edit')
                ->slot('Edit: '.$row->id)
                ->id()
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('edit', ['rowId' => $row->id])
        ];
    }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
