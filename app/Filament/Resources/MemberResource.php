<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MemberResource\Pages;
use App\Filament\Resources\MemberResource\RelationManagers;
use App\Models\Member;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MemberResource extends Resource
{
    protected static ?string $model = Member::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('firstname')
                    ->required()
                    ->translateLabel(),
                Forms\Components\TextInput::make('lastname')
                    ->required()
                    ->translateLabel(),
                Forms\Components\TextInput::make('street')
                    ->translateLabel(),
                Forms\Components\TextInput::make('house_number')
                    ->translateLabel(),
                Forms\Components\TextInput::make('phone')
                    ->translateLabel(),
                Forms\Components\TextInput::make('mobile')
                    ->translateLabel(),
                Forms\Components\TextInput::make('mail')
                    ->translateLabel(),
                Forms\Components\DatePicker::make('birthdate')
                    ->translateLabel()
                    ->displayFormat('d.m.Y'),
                Forms\Components\Select::make('gender')
                    ->translateLabel()
                    ->options([
                    'm' => __('Male'),
                    'f' => __('Female'),
                    'd' => __('Diverse'),
                ]),
                Forms\Components\TextInput::make('nationality')
                    ->translateLabel(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('firstname'),
                TextColumn::make('lastname')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMembers::route('/'),
            'create' => Pages\CreateMember::route('/create'),
            'edit' => Pages\EditMember::route('/{record}/edit'),
        ];
    }
}
