<?php

namespace App\Livewire\Sdm;

use App\Jobs\Sdm\SynchronizeSpreadsheetUser;
use App\Livewire\Notifikasi\NotifikasiDefault;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Halaman Relasi Karyawan')]
class RelasiKaryawan extends Component
{
    public function render()
    {
        return view('livewire.sdm.relasi-karyawan');
    }

    public function sync()
    {
        SynchronizeSpreadsheetUser::dispatch();
        return $this->dispatch('notifSuccess', title: 'Relasi', description: 'relasi karyawan dilakukan!.')->to(NotifikasiDefault::class);
    }
}
