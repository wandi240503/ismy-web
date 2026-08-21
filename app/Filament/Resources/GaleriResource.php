<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GaleriResource\Pages;
use App\Models\Galeri;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class GaleriResource extends Resource
{
    protected static ?string $model = Galeri::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationGroup = 'Publikasi & Konten';

    protected static ?string $navigationLabel = 'Galeri Dokumentasi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Album Dokumentasi')
                    ->schema([
                        Forms\Components\TextInput::make('judul')
                            ->label('Nama Album / Kegiatan')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\DatePicker::make('tanggal')
                            ->label('Tanggal Kegiatan')
                            ->default(now())
                            ->required(),
                        Forms\Components\Textarea::make('deskripsi')
                            ->label('Keterangan / Cerita Dokumentasi')
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Daftar Foto / Video')
                    ->schema([
                        Forms\Components\Repeater::make('media')
                            ->relationship()
                            ->schema([
                                Forms\Components\FileUpload::make('file_path')
                                    ->label('Unggah Foto / Video')
                                    ->image()
                                    ->disk('public')
                                    ->directory('galeri')
                                    ->required(),
                                Forms\Components\Select::make('tipe')
                                    ->label('Jenis Media')
                                    ->options([
                                        'foto' => 'Foto / Gambar',
                                        'video' => 'Video',
                                    ])
                                    ->default('foto')
                                    ->required(),
                                Forms\Components\TextInput::make('keterangan')
                                    ->label('Keterangan Singkat Foto')
                                    ->placeholder('Dokumentasi pembukaan simposium...'),
                            ])
                            ->columns(3)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('judul')
                    ->label('Nama Album')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('media_count')
                    ->label('Jumlah Media')
                    ->counts('media'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListGaleris::route('/'),
            'create' => Pages\CreateGaleri::route('/create'),
            'edit' => Pages\EditGaleri::route('/{record}/edit'),
        ];
    }
}
