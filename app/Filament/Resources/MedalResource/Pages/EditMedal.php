<?php

namespace App\Filament\Resources\MedalResource\Pages;

use App\Filament\Resources\MedalResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMedal extends EditRecord
{
    protected static string $resource = MedalResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
