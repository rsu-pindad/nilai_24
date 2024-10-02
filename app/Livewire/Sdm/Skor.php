<?php

namespace App\Livewire\Sdm;

use App\Livewire\Forms\Sdm\Aspek\AspekForm;
use App\Livewire\Forms\Sdm\Indikator\IndikatorForm;
use App\Livewire\Forms\Sdm\Skor\SkorForm;
use App\Livewire\Notifikasi\NotifikasiDefault;
use App\Models\Aspek;
use App\Models\Indikator;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Halaman Skor')]
class Skor extends Component
{
    public SkorForm $skorForm;
    public AspekForm $aspekForm;
    public IndikatorForm $indikatorForm;

    public function updatedAspekID()
    {
        $this->skorForm->indikator = null;
    }

    #[Computed()]
    public function aspeks()
    {
        return Aspek::all();
    }

    #[Computed()]
    public function indikators()
    {
        return Indikator::where('aspek_id', $this->skorForm->aspek)->get();
    }

    public function render()
    {
        return view('livewire.sdm.skor');
    }

    public function insertSkor()
    {
        $store = $this->skorForm->store();
        if (!$store) {
            return $this->dispatch('notifError', title: 'Skor', description: $store)->to(NotifikasiDefault::class);
        }

        return $this->dispatch('notifSuccess', title: 'Skor', description: 'skor data berhasil ditambahkan')->to(NotifikasiDefault::class);
    }

    public function insertAspek()
    {
        $store = $this->aspekForm->store();
        if (!$store) {
            return $this->dispatch('notifError', title: 'Aspek', description: $store)->to(NotifikasiDefault::class);
        }

        return $this->dispatch('notifSuccess', title: 'Aspek', description: 'aspek data berhasil ditambahkan')->to(NotifikasiDefault::class);
    }

    public function insertIndikator()
    {
        $store = $this->indikatorForm->store();
        if (!$store) {
            return $this->dispatch('notifError', title: 'Indikator', description: $store)->to(NotifikasiDefault::class);
        }

        return $this->dispatch('notifSuccess', title: 'Indikator', description: 'indikator data berhasil ditambahkan')->to(NotifikasiDefault::class);
    }
}
