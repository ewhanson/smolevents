<?php

namespace App\Filament\Resources\EventResource\Widgets;

use App\Models\Event;
use App\Models\Invite;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class InviteCount extends BaseWidget
{
    public ?Event $record = null;

    protected function getCards(): array
    {
        return [
            Card::make('Invited', $this->record->invites()->count()),
            Card::make('Responded', $this->getHasRespondedCount()),
            Card::make('Attending', $this->getAttendingCount()),
        ];
    }

    private function getHasRespondedCount(): int
    {
        return $this->record
            ->invites()
            ->getResults()
            ->reduce(function (int $carry, Invite $invite) {
                if ($invite->has_responded) {
                    $carry++;
                }

                return $carry;
            }, 0);
    }

    private function getAttendingCount(): int
    {
        return $this->record
            ->invites()
            ->getResults()
            ->reduce(function (int $carry, Invite $invite) {
                if ($invite->is_attending) {
                    $carry += $invite->number_attending;
                }

                return $carry;
            }, 0);
    }
}
