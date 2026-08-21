<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengurusResource\Pages;
use App\Models\Pengurus;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PengurusResource extends Resource
{
    protected static ?string $model = Pengurus::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Kepengurusan & Wilayah';

    protected static ?string $navigationLabel = 'Jajaran Pengurus';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->label('Nama Lengkap & Gelar')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Prof. Dr. Ahmad Zulkifli'),
                Forms\Components\Select::make('jabatan_id')
                    ->label('Jabatan Organisasi')
                    ->relationship('jabatan', 'nama')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\TextInput::make('periode')
                    ->label('Periode Kepengurusan')
                    ->required()
                    ->maxLength(255)
                    ->default('2024-2026'),
                Forms\Components\TextInput::make('urutan')
                    ->label('Nomor Urutan Tampilan')
                    ->numeric()
                    ->default(0)
                    ->helperText('Angka lebih kecil akan tampil lebih awal di bagan organisasi.'),
                Forms\Components\FileUpload::make('foto')
                    ->label('Foto Pengurus')
                    ->image()
                    ->disk('public')
                    ->directory('pengurus')
                    ->avatar()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('foto')
                    ->label('Foto')
                    ->disk('public')
                    ->circular(),
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jabatan.nama')
                    ->label('Jabatan')
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('periode')
                    ->label('Periode')
                    ->sortable(),
                Tables\Columns\TextColumn::make('urutan')
                    ->label('Urutan')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('urutan', 'asc')
            ->filters([
                Tables\Filters\SelectFilter::make('jabatan_id')
                    ->label('Jabatan')
                    ->relationship('jabatan', 'nama'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPenguruses::route('/'),
            'create' => Pages\CreatePengurus::route('/create'),
            'edit' => Pages\EditPengurus::route('/{record}/edit'),
        ];
    }
}
