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
        $sync = SynchronizeSpreadsheetUser::dispatch();
        if (!$sync) {
            return $this->dispatch('notifError', title: 'Relasi', description: $sync)->to(NotifikasiDefault::class);
        }

        return $this->dispatch('notifSuccess', title: 'Relasi', description: 'relasi karyawan dilakukan!.')->to(NotifikasiDefault::class);
    }
}
