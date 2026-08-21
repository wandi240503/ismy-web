<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DokumenResource\Pages;
use App\Models\Dokumen;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DokumenResource extends Resource
{
    protected static ?string $model = Dokumen::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Publikasi & Konten';

    protected static ?string $navigationLabel = 'Dokumen & Regulasi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Dokumen')
                    ->schema([
                        Forms\Components\TextInput::make('judul')
                            ->label('Judul / Nama Dokumen')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Contoh: AD-ART ISMY 2024'),
                        Forms\Components\Select::make('kategori')
                            ->label('Kategori Dokumen')
                            ->options([
                                'ad_art' => 'AD / ART Organisasi',
                                'sk' => 'Surat Keputusan (SK)',
                                'laporan' => 'Laporan Pertanggungjawaban (LPJ)',
                                'umum' => 'Dokumen Umum / Panduan',
                            ])
                            ->default('umum')
                            ->required(),
                        Forms\Components\FileUpload::make('file_path')
                            ->label('Unggah File Berkas (PDF/DOC)')
                            ->disk('public')
                            ->directory('dokumens')
                            ->acceptedFileTypes(['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('deskripsi')
                            ->label('Keterangan Singkat')
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('judul')
                    ->label('Judul')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kategori')
                    ->label('Kategori')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'ad_art' => 'warning',
                        'sk' => 'info',
                        'laporan' => 'success',
                        default => 'gray',
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('file_path')
                    ->label('Nama Berkas')
                    ->limit(30),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tgl Unggah')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kategori')
                    ->options([
                        'ad_art' => 'AD / ART',
                        'sk' => 'SK',
                        'laporan' => 'Laporan',
                        'umum' => 'Umum',
                    ]),
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
            'index' => Pages\ListDokumens::route('/'),
            'create' => Pages\CreateDokumen::route('/create'),
            'edit' => Pages\EditDokumen::route('/{record}/edit'),
        ];
    }
}
