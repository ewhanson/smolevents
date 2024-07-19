<?php

namespace App\Filament\Resources\EventResource\Pages;

use App\Actions\SendInvites;
use App\Filament\Resources\EventResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewEvent extends ViewRecord
{
    protected static string $resource = EventResource::class;

    protected function getActions(): array
    {
        $resource = static::getResource();

        if (! $resource::canEdit($this->getRecord())) {
            return parent::getActions();
        }

        $actions = [];

        if (!$this->data['is_active']) {
            $actions[] = Actions\Action::make('launchEvent')
                ->action('launchEvent')
                ->color('success')
                ->requiresConfirmation();
        }

        $parentActions = parent::getActions();
        return array_merge($actions, $parentActions);
    }

    protected function getHeaderWidgets(): array
    {
        return [
            EventResource\Widgets\EventStatus::class,
            EventResource\Widgets\InviteCount::class,
        ];
    }

    public function launchEvent(): void
    {
        $this->record->is_active = true;

        try {
            (new SendInvites($this->record))->execute();
        } catch(\Exception $exception) {
            // TODO: Error message about how sending email didn't work
            // Mostly we don't want to save record if sending invites didn't go well
        } finally {
            $this->record->save();
            $this->refreshFormData(['is_active']);
        }
    }
}
