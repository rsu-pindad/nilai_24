<?php

namespace App\Livewire\Sdm;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Halaman Manajemen User')]
class UserMgmt extends Component
{
    public function render()
    {
        return view('livewire.sdm.user-mgmt');
    }
}
