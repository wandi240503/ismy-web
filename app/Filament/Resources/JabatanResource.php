<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JabatanResource\Pages;
use App\Models\Jabatan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class JabatanResource extends Resource
{
    protected static ?string $model = Jabatan::class;

    protected static ?string $navigationIcon = 'heroicon-o-identification';
    
    protected static ?string $navigationGroup = 'Master Data';

    protected static ?string $navigationLabel = 'Jabatan Organisasi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->label('Nama Jabatan')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Contoh: Ketua Umum, Dewan Pembina'),
                Forms\Components\Select::make('level')
                    ->label('Tingkatan / Divisi')
                    ->options([
                        'dewan_pembina' => 'Dewan Pembina / Majelis Syura',
                        'ketua' => 'Ketua Umum / Wakil',
                        'sekretaris' => 'Sekretaris Jenderal',
                        'bendahara' => 'Bendahara Umum',
                        'departemen' => 'Departemen / Bidang',
                        'wilayah' => 'Pengurus Wilayah / Cabang',
                        'anggota' => 'Anggota Biasa',
                    ])
                    ->required()
                    ->default('departemen'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Jabatan')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('level')
                    ->label('Level')
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('pengurus_count')
                    ->label('Total Pengurus')
                    ->counts('pengurus'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
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
            'index' => Pages\ListJabatans::route('/'),
            'create' => Pages\CreateJabatan::route('/create'),
            'edit' => Pages\EditJabatan::route('/{record}/edit'),
        ];
    }
}
