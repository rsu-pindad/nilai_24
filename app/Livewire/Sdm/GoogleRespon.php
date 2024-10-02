<?php

namespace App\Livewire\Sdm;

use App\Jobs\Sdm\SynchronizeSpreadsheetRespon;
use App\Livewire\Notifikasi\NotifikasiDefault;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Halaman Goole Respon')]
class GoogleRespon extends Component
{
    public function render()
    {
        return view('livewire.sdm.google-respon');
    }

    public function sync()
    {
        $sync = SynchronizeSpreadsheetRespon::dispatch();
        if (!$sync) {
            return $this->dispatch('notifError', title: 'Respon', description: $sync)->to(NotifikasiDefault::class);
        }

        return $this->dispatch('notifSuccess', title: 'Respon', description: 'respon google dilakukan!.')->to(NotifikasiDefault::class);
    }
}
