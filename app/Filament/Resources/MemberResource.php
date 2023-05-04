<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MemberResource\Pages;
use App\Filament\Resources\MemberResource\RelationManagers;
use App\Models\Member;
use Carbon\Carbon;
use Closure;
use Filament\Forms;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Section;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class MemberResource extends Resource
{
    protected static ?string $model = Member::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function getLabel(): ?string
    {
        return __('Member');
    }

    public static function getPluralLabel(): string
    {
        return __('Members');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Personalien')
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
                        Forms\Components\TextInput::make('zip_code')
                            ->translateLabel(),
                        Forms\Components\TextInput::make('city')
                            ->translateLabel(),
                        Forms\Components\TextInput::make('phone')
                            ->translateLabel(),
                        Forms\Components\TextInput::make('mobile')
                            ->translateLabel(),
                        Forms\Components\TextInput::make('mail')
                            ->translateLabel(),
                        Forms\Components\DatePicker::make('birthdate')
                            ->translateLabel()
                            ->displayFormat('d.m.Y')
                            ->reactive()
                            ->afterStateUpdated(function (Closure $set, $state) {
                                $set('age', Carbon::parse($state)->age);
                            }),
                        Forms\Components\TextInput::make('age')
                            ->translateLabel()
                            ->disabled()
                            ->dehydrated(false),
                        Forms\Components\Select::make('gender')
                            ->translateLabel()
                            ->options([
                                'm' => __('Male'),
                                'f' => __('Female'),
                                'd' => __('Diverse'),
                            ]),
                        Forms\Components\TextInput::make('nationality')
                            ->translateLabel(),
                    ])->collapsible(),
                Section::make(__('Education'))
                    ->schema([
                        Forms\Components\TextInput::make('school_name')
                            ->translateLabel(),
                        Forms\Components\TextInput::make('class_name')
                            ->translateLabel(),
                    ])
                    ->collapsible(),
                Section::make(__('Clubs and organizations'))
                    ->schema([
                        Forms\Components\TextInput::make('other_clubs_and_organisations')
                            ->translateLabel()
                            ->hint('Ich bin aktives Mitglied in folgenden Vereinen oder Organisationen:'),
                    ])
                    ->collapsible(),
                Section::make(__('Health and physical limitations'))
                    ->schema([
                        Radio::make('is_swimmer')
                            ->translateLabel()
                            ->options([
                                '1' => __('Yes'),
                                '0' => __('No'),
                            ]),
                        Forms\Components\TextInput::make('health_insurance')
                            ->translateLabel(),
                        Forms\Components\TextInput::make('physical_limitations')
                            ->translateLabel()
                            ->hint('Folgende Krankheiten, Behinderungen, Beschwerden und Allergien (auch Arzneimittelunverträglichkeiten) sind bekannt:'),
                        Forms\Components\TextInput::make('shoe_size')
                            ->translateLabel(),
                        Forms\Components\TextInput::make('size')
                            ->translateLabel(),
                        Radio::make('is_glasses_wearer')
                            ->translateLabel()
                            ->options([
                                '1' => __('Yes'),
                                '0' => __('No'),
                            ]),
                    ])
                    ->collapsible(),
                Section::make(__('Image rights and privacy'))
                    ->schema([
                        Radio::make('accepted_data_protection_rules')
                            ->translateLabel()
                            ->options([
                                '1' => __('Yes'),
                                '0' => __('No'),
                            ]),
                        Radio::make('given_image_rights')
                            ->translateLabel()
                            ->options([
                                '1' => __('Yes'),
                                '0' => __('No'),
                            ]),
                        Radio::make('accepted_data_protection_database')
                            ->translateLabel()
                            ->options([
                                '1' => __('Yes'),
                                '0' => __('No'),
                            ]),
                    ])
                    ->collapsible(),
                Section::make(__('Pick up permissions'))
                    ->schema([
                        CheckboxList::make('pick_up_permissions')
                            ->translateLabel()
                            ->options([
                                'go_home_alone' => __('go_home_alone'),
                                'is_picked_up' => __('is_picked_up'),
                                'written_message' => __('written_message'),
                            ])
                            ->default(false),
                        Forms\Components\TextInput::make('authorized_for_pickup')
                            ->translateLabel(),
                    ])
                    ->collapsible(),
                Section::make(__('admission'))
                    ->schema([
                        Radio::make('admission_organization')
                            ->translateLabel()
                            ->options([
                                '1' => __('Yes'),
                                '0' => __('No'),
                            ]),
                        Radio::make('admission_fire_department')
                            ->translateLabel()
                            ->options([
                                '1' => __('Yes'),
                                '0' => __('No'),
                            ]),
                        Forms\Components\DatePicker::make('date_admission')
                            ->translateLabel(),
                    ])
                    ->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('firstname')->translateLabel(),
                TextColumn::make('lastname')->translateLabel(),
                TextColumn::make('age')
                    ->translateLabel()
                    ->extraAttributes(function (Member $record) {
                        if ($record->birthdate->isBirthday()) {
                            return ['class' => 'bg-success-500'];
                        }
                        return [];
                    }),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
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
