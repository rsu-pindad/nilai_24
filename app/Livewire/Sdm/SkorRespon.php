<?php

namespace App\Livewire\Sdm;

use App\Jobs\Sdm\Skor\SyncAtasan;
use App\Jobs\Sdm\Skor\SyncRekanan;
use App\Jobs\Sdm\Skor\SyncSelf;
use App\Jobs\Sdm\Skor\SyncStaff;
use App\Livewire\Notifikasi\NotifikasiDefault;
use Illuminate\Support\Facades\Bus;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Halaman Hitung Skor Respon')]
class SkorRespon extends Component
{
    public function render()
    {
        return view('livewire.sdm.skor-respon');
    }

    public function calculate()
    {
        $sync = Bus::batch([
            [
                new SyncSelf,
            ],
            [
                new SyncAtasan,
            ],
            [
                new SyncRekanan,
            ],
            [
                new SyncStaff,
            ],
        ])->onConnection('redis')->onQueue('hitung-skor')->dispatch();
        if (!$sync) {
            return $this->dispatch('notifError', title: 'Hitung Skor Respon', description: $sync)->to(NotifikasiDefault::class);
        }

        return $this->dispatch('notifSuccess', title: 'Hitung Skor Respon', description: 'hitung skor respon dilakukan!.')->to(NotifikasiDefault::class);
    }
}
