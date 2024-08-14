<?php

namespace App\Models;

use App\Enums\GenderEnum;
use App\Enums\IdentityTypeEnum;
use App\Enums\NameTitleEnum;
use App\Enums\UserRole;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Set;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Instructor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'department_id',
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

    public function department(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'course_instructors');
    }

    public static function getForm(): array
    {
        return [
            Section::make('Instructor Information')
                ->columns(2)
                ->schema([
                    Select::make('user_id')
                        ->label('User')
                        ->createOptionForm(User::getForm())
                        ->editOptionForm(User::getForm())
                        ->relationship('user', 'name', modifyQueryUsing: function (Builder $query, $livewire) {
                            $query->where('role', UserRole::INSTRUCTOR->value)
                                ->whereDoesntHave('instructor');

                            // If editing, include the currently selected user
                            if ($livewire->record) {
                                $currentUserId = $livewire->record->user_id;
                                $query->orWhere('id', $currentUserId);
                            }

                            return $query;
                        })
                        ->searchable()
                        ->preload(),
                    Select::make('department_id')
                        ->label('Department')
                        ->relationship('department', 'name')
                        ->createOptionForm(Department::getForm())
                        ->editOptionForm(Department::getForm())
                        ->searchable()
                        ->preload(),
                    Select::make('title')
                        ->label('Title')
                        ->options(NameTitleEnum::class)
                        ->default(NameTitleEnum::MR->value)
                        ->required(),
                    Select::make('gender')
                        ->label('Gender')
                        ->options(GenderEnum::class)
                        ->default(GenderEnum::MALE->value)
                        ->required(),
                    Select::make('identity_type')
                        ->label('Identity Type')
                        ->options(IdentityTypeEnum::class)
                        ->default(IdentityTypeEnum::NRC->value)
                        ->required(),
                    TextInput::make('identity_number')
                        ->label('Identity Number')
                        ->maxLength(255),
                    Select::make('Courses')
                        ->searchable()
                        ->relationship('courses', 'name')
                        ->preload()
                        ->multiple(),
                ]),
        ];
    }
}
