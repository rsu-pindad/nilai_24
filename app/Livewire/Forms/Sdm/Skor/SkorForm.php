<?php

namespace App\Livewire\Forms\Sdm\Skor;

use App\Models\ScoreJawaban;
use Livewire\Attributes\Validate;
use Livewire\Form;

class SkorForm extends Form
{
    #[Validate('required', message: 'mohon pilih aspek')]
    public $aspek = null;

    #[Validate('required', message: 'mohon pilih indikator')]
    public $indikator = null;

    #[Validate('required', message: 'mohon isi jawaban')]
    #[Validate('min:20', message: 'minimal 20 huruf')]
    public $jawaban = null;

    #[Validate('required', message: 'mohon isi jawaban')]
    #[Validate('min:1', message: 'minimal angka 1')]
    #[Validate('max:9', message: 'maksimal angka 9')]
    #[Validate('numeric', message: 'hanya angka')]
    public $skorJawaban = null;

    public function store()
    {
        $this->validate();
        try {
            $insert               = new ScoreJawaban();
            $insert->aspek_id     = $this->aspek;
            $insert->indikator_id = $this->indikator;
            $insert->jawaban      = $this->jawaban;
            $insert->skor         = $this->skorJawaban;
            $insert->save();
            $this->reset('jawaban', 'skorJawaban');

            return $insert;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    
}
