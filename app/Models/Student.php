<?php

namespace App\Models;

use App\Enums\GenderEnum;
use App\Enums\IdentityTypeEnum;
use App\Enums\NameTitleEnum;
use App\Enums\UserRole;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'first_name',
        'last_name',
        'gender',
        'date_of_birth',
        'identity_type',
        'identity_number',
        'country',
        'nationality',
        'city',
        'township',
        'address',
        'contact_person',
        'contact_person_relationship',
        'contact_person_mobile_number',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function getForm()
    {
        return [

            Section::make('Student Information')
                ->columns(2)
                ->schema([
                    Select::make('user_id')
                        ->label('User')
                        ->createOptionForm(User::getForm())
                        ->editOptionForm(User::getForm())
                        ->relationship('user', 'name', modifyQueryUsing: function (Builder $query, $livewire) {
                            $query->where('role', UserRole::STUDENT->value)
                                ->whereDoesntHave('student');

                            // If editing, include the currently selected user
                            if ($livewire->record) {
                                $currentUserId = $livewire->record->user_id;
                                $query->orWhere('id', $currentUserId);
                            }

                            return $query;
                        })
                        ->searchable()
                        ->preload(),
                    Select::make('title')
                        ->label('Title')
                        ->options(NameTitleEnum::class)
                        ->default(NameTitleEnum::MR->value)
                        ->required(),
                    TextInput::make('first_name')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('last_name')
                        ->required()
                        ->maxLength(255),
                    Select::make('gender')
                        ->label('Gender')
                        ->options(GenderEnum::class)
                        ->default(GenderEnum::MALE->value)
                        ->required(),
                    DatePicker::make('date_of_birth')
                        ->native(false)
                        ->displayFormat('d/m/Y')
                        ->required(),
                    Select::make('identity_type')
                        ->label('Identity Type')
                        ->options(IdentityTypeEnum::class)
                        ->default(IdentityTypeEnum::NRC->value)
                        ->required(),
                    TextInput::make('identity_number')
                        ->label('Identity Number')
                        ->maxLength(255),
                ]),

            Section::make('Other Information')
                ->schema([
                    TextInput::make('country')
                        ->maxLength(255),
                    TextInput::make('nationality')
                        ->maxLength(255),
                    TextInput::make('city')
                        ->maxLength(255),
                    TextInput::make('township')
                        ->maxLength(255),
                    Textarea::make('address')
                        ->columnSpanFull(),
                    TextInput::make('contact_person')
                        ->maxLength(255),
                    TextInput::make('contact_person_relationship')
                        ->maxLength(255),
                    TextInput::make('contact_person_mobile_number')
                        ->maxLength(255),
                ])
        ];
    }
}
