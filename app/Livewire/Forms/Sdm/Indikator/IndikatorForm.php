<?php

namespace App\Livewire\Forms\Sdm\Indikator;

use App\Models\Indikator;
use Livewire\Attributes\Validate;
use Livewire\Form;

class IndikatorForm extends Form
{
    #[Validate('required', message: 'mohon pilih aspek')]
    public $aspek = null;

    #[Validate('required', message: 'mohon isi indikator')]
    #[Validate('min:5', message: 'minimal 5 huruf')]
    public $indikator = null;

    public function store()
    {
        $this->validate();
        try {
            $insert                 = new Indikator();
            $insert->aspek_id       = $this->aspek;
            $insert->nama_indikator = $this->indikator;
            $insert->save();
            $this->reset(
                'indikator'
            );

            return $insert;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
