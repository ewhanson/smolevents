<?php

namespace App\Filament\Resources\EventResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InvitesRelationManager extends RelationManager
{
    protected static string $relationship = 'invites';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->required()
                    ->email(),
                Forms\Components\Toggle::make('is_attending'),
                Forms\Components\Toggle::make('has_responded'),
                Forms\Components\TextInput::make('number_attending')->numeric()->default(0),
                Forms\Components\TextInput::make('comments'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\IconColumn::make('is_attending')->boolean(),
                Tables\Columns\IconColumn::make('has_responded')->boolean(),
                Tables\Columns\TextColumn::make('number_attending'),
            ])
            ->filters([
                Tables\Filters\Filter::make('has_responded')
                    ->query(fn (Builder $query): Builder => $query->where('has_responded', true))
                    ->toggle(),
                Tables\Filters\Filter::make('is_attending')
                    ->query(fn (Builder $query): Builder => $query->where('is_attending', true))
                    ->toggle(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
