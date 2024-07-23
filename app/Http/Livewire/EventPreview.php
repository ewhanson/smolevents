<?php

namespace App\Http\Livewire;

use App\Models\Event;
use Livewire\Component;

class EventPreview extends Component
{
    public Event $event;

    public function render()
    {
        return view('livewire.event-preview')
            ->extends('layouts.app');
    }
}
