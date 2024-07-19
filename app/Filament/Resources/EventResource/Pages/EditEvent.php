<?php

namespace App\Filament\Resources\EventResource\Pages;

use App\Actions\SendInvites;
use App\Filament\Resources\EventResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEvent extends EditRecord
{
    protected static string $resource = EventResource::class;

    protected function getActions(): array
    {
        $actions = [];

        if (!$this->data['is_active']) {
            $actions[] = Actions\Action::make('launchEvent')
                ->action('launchEvent')
                ->color('success')
                ->requiresConfirmation();
        } else {
            $actions[] = Actions\Action::make('closeEvent')
                ->action('closeEvent')
                ->color('danger')
                ->requiresConfirmation();
        }
        $actions[] = Actions\DeleteAction::make();
        return $actions;
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

    public function closeEvent(): void
    {
        $this->record->is_active = false;
        $this->record->save();
        $this->refreshFormData(['is_active']);

    }

}
