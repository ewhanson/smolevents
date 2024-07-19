<?php

namespace App\Filament\Resources\EventResource\Widgets;

use App\Models\Event;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class EventStatus extends BaseWidget
{
    public ?Event $record = null;

    protected int | string | array $columnSpan = 1;

    protected function getCards(): array
    {
        return [
            BaseWidget\Card::make('Launch Status', $this->getText()),
        ];
    }

    private function getText(): string
    {
        return $this->record->is_active ? 'Live 🚀' : 'Draft 📝';
    }
}
