<?php

namespace App\Filament\Widgets;

use App\Models\Pengurus;
use App\Models\Jabatan;
use Filament\Forms;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class PengurusListWidget extends BaseWidget
{
    protected static ?int $sort = 4;

    protected int | string | array $columnSpan = 'full';

    protected static ?string $heading = '👥 Jajaran Pengurus Organisasi ISMY (Struktur & Periode)';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Pengurus::query()->with('jabatan')->orderBy('urutan', 'asc')
            )
            ->columns([
                Tables\Columns\ImageColumn::make('foto')
                    ->label('Foto')
                    ->disk('public')
                    ->circular(),
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Pengurus')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jabatan.nama')
                    ->label('Jabatan')
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('periode')
                    ->label('Periode Kepengurusan')
                    ->sortable(),
                Tables\Columns\TextColumn::make('urutan')
                    ->label('Nomor Urutan')
                    ->sortable(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Tambah Pengurus Baru')
                    ->model(Pengurus::class)
                    ->form([
                        Forms\Components\TextInput::make('nama')
                            ->label('Nama Lengkap & Gelar')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('jabatan_id')
                            ->label('Jabatan')
                            ->relationship('jabatan', 'nama')
                            ->required(),
                        Forms\Components\TextInput::make('periode')
                            ->label('Periode (contoh: 2026-2028)')
                            ->required()
                            ->default('2024-2026'),
                        Forms\Components\TextInput::make('urutan')
                            ->label('Urutan Tampilan')
                            ->numeric()
                            ->default(1),
                        Forms\Components\FileUpload::make('foto')
                            ->label('Pas Foto Pengurus')
                            ->image()
                            ->disk('public')
                            ->directory('pengurus')
                            ->avatar(),
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Edit Pengurus')
                    ->form([
                        Forms\Components\TextInput::make('nama')
                            ->label('Nama Lengkap & Gelar')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('jabatan_id')
                            ->label('Jabatan')
                            ->relationship('jabatan', 'nama')
                            ->required(),
                        Forms\Components\TextInput::make('periode')
                            ->label('Periode')
                            ->required(),
                        Forms\Components\TextInput::make('urutan')
                            ->label('Urutan')
                            ->numeric()
                            ->required(),
                        Forms\Components\FileUpload::make('foto')
                            ->label('Pas Foto')
                            ->image()
                            ->disk('public')
                            ->directory('pengurus')
                            ->avatar(),
                    ]),
                Tables\Actions\DeleteAction::make(),
            ])
            ->paginated([5, 10, 25]);
    }
}
