<?php

namespace App\Livewire\Forms\Sdm\Aspek;

use App\Models\Aspek;
use Livewire\Attributes\Validate;
use Livewire\Form;

class AspekForm extends Form
{
    #[Validate('required', message: 'mohon isi aspek')]
    #[Validate('min:5', message: 'minimal 5 huruf')]
    public $aspek = null;

    public function store()
    {
        $this->validate();
        try {
            $insert             = new Aspek();
            $insert->nama_aspek = $this->aspek;
            $insert->save();
            $this->reset(
                'aspek',
            );

            return $insert;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
