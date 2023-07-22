<?php

namespace App\Http\Livewire;

use App\Models\Event;
use Livewire\Component;

class Invite extends Component
{
    public \App\Models\Invite $invite;

    protected $rules = [
        'invite.is_attending' => 'required|boolean',
        'invite.number_attending' => 'required|digits_between:0,5',
        'invite.comments' => 'string|nullable|max:255'
    ];

    public function render()
    {
            return view('livewire.invite')
                ->extends('layouts.app');
    }

    public function save()
    {
        $this->validate();

        $this->invite->has_responded = true;

        $this->invite->save();

        session()->flash('message', 'Invite details saved!  👍');
    }
}
