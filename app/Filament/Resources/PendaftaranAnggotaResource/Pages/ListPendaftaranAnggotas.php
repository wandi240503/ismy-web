<?php

namespace App\Filament\Resources\PendaftaranAnggotaResource\Pages;

use App\Filament\Resources\PendaftaranAnggotaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPendaftaranAnggotas extends ListRecords
{
    protected static string $resource = PendaftaranAnggotaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
