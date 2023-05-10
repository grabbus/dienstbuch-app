<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MemberResource\Pages;
use App\Models\Member;
use Carbon\Carbon;
use Closure;
use Filament\Forms;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Tabs;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class MemberResource extends Resource
{
    protected static ?string $model = Member::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

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
                // TABS
                Tabs::make('Heading')
                    ->tabs([
                        Tabs\Tab::make('1')
                            ->icon('heroicon-o-identification')
                            ->schema([Forms\Components\Section::make(__('Personal data'))
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
                                        ->translateLabel()
                                        ->email(),
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
                                ])->columns(2),
                            ]),
                        Tabs\Tab::make('2')
                            ->icon('heroicon-o-users')
                            ->schema([
                                Forms\Components\Section::make(__('Guardians'))
                                    ->schema([
                                        Repeater::make('guardians')
                                            ->disableLabel()
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
                                                Forms\Components\TextInput::make('phone_business')
                                                    ->translateLabel(),
                                                Forms\Components\TextInput::make('mail')
                                                    ->translateLabel()
                                                    ->email(),
                                            ])
                                            ->columns(2),
                                    ]),
                            ]),
                        Tabs\Tab::make('3')
                            ->icon('heroicon-o-academic-cap')
                            ->schema([
                                Forms\Components\Section::make(__('Education'))
                                    ->schema([
                                        Forms\Components\TextInput::make('school_name')
                                            ->translateLabel(),
                                        Forms\Components\TextInput::make('class_name')
                                            ->translateLabel(),
                                    ]),
                            ]),
                        Tabs\Tab::make('4')
                            ->icon('heroicon-o-library')
                            ->schema([
                                Forms\Components\TextInput::make('other_clubs_and_organisations')
                                    ->translateLabel()
                                    ->hint('Ich bin aktives Mitglied in folgenden Vereinen oder Organisationen:'),
                            ]),
                        Tabs\Tab::make('5')
                            ->icon('heroicon-o-heart')
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
                            ]),
                        Tabs\Tab::make('6')
                            ->icon('heroicon-o-scale')
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
                            ]),
                        Tabs\Tab::make('7')
                            ->icon('heroicon-o-hand')
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
                            ]),
                        Tabs\Tab::make('8')
                            ->icon('heroicon-o-check-circle')
                            ->schema([
                                Forms\Components\Section::make(__('Admission'))
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
                                            ->translateLabel()
                                            ->displayFormat('d.m.Y'),
                                    ])->columns(2),
                            ]),
                    ])->columnSpanFull(),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMembers::route('/'),
            'create' => Pages\CreateMember::route('/create'),
            'edit' => Pages\EditMember::route('/{record}/edit'),
        ];
    }
}
