<?php

namespace App\Livewire\Power\Sdm;

use App\Models\ScoreJawaban;
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
use App\Models\Aspek;
use App\Models\Indikator;

final class SkorTable extends PowerGridComponent
{
    use WithExport;

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()
                ->showToggleColumns()
                ->showSearchInput(),
            Footer::make()
                ->pageName('skorTabel')
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return ScoreJawaban::query();
    }

    public function relationSearch(): array
    {
        // return ScoreJawaban::with([
        //     'aspek' => function ($query) {
        //         return $query->aspek->nama_aspek;
        //     },
        //     'indikator' => function ($query) {
        //         return $query->indikator->nama_indikator;
        //     }
        // ]);
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
                   ->add('id')
                   ->add('aspek_id')
                   ->add('aspek_id_label', function ($query) {
                       return $query->aspek->nama_aspek;
                   })
                   ->add('indikator_id')
                   ->add('indikator_id_label', function ($query) {
                       return $query->indikator->nama_indikator;
                   })
                   ->add('jawaban')
                   ->add('skor');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id')
                ->hidden(isHidden: true, isForceHidden: false),
            Column::make('No', 'id')
                ->index(),
            // Column::make('Aspek ', 'aspek_id'),
            Column::make('Aspek ', 'aspek_id_label', 'aspek_id'),
            Column::make('Indikator', 'indikator_id_label', 'indikator_id'),
            Column::make('Jawaban', 'jawaban')
                ->sortable()
                ->searchable(),
            Column::make('Skor', 'skor')
                ->sortable()
                ->searchable(),
            Column::action('Aksi')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::select('aspek_id_label','aspek_id')
            ->dataSource(Aspek::all())
            ->optionLabel('nama_aspek')
            ->optionValue('id'),
            Filter::select('indikator_id_label','indikator_id')
            ->dataSource(Indikator::all())
            ->optionLabel('nama_indikator')
            ->optionValue('id')
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert(' . $rowId . ')');
    }

    public function actions(ScoreJawaban $row): array
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
