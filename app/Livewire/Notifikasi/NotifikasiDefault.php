<?php

namespace App\Livewire\Notifikasi;

use Livewire\Attributes\On;
use Livewire\Component;
use WireUi\Traits\WireUiActions;

class NotifikasiDefault extends Component
{
    use WireUiActions;

    #[On('notifInfo')]
    public function infoNotification($title, $description): void
    {
        $this->notification()->send([
            'icon'        => 'info',
            'title'       => $title,
            'description' => $description,
        ]);
    }

    #[On('notifError')]
    public function errorNotification($title, $description): void
    {
        $this->notification()->send([
            'icon'        => 'error',
            'title'       => $title,
            'description' => $description,
        ]);
    }

    #[On('notifSuccess')]
    public function successNotification($title, $description): void
    {
        $this->notification()->send([
            'icon'        => 'success',
            'title'       => $title,
            'description' => $description,
        ]);
    }

    public function render()
    {
        return view('livewire.notifikasi.notifikasi-default');
    }
}
