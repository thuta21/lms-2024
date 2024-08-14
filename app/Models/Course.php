<?php

namespace App\Models;

use App\Enums\ContentStatus;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'description',
        'summary',
        'fee',
        'duration',
        'status',
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function instructors(): BelongsToMany
    {
        return $this->belongsToMany(Instructor::class, 'course_instructors');
    }

    public static function getForm(): array
    {
        return [
            Section::make('Course Information')
                ->columns(2)
                ->schema([
                    Fieldset::make('Basic Information')
                        ->schema([
                            TextInput::make('name')
                                ->required()
                                ->maxLength(255),
                            TextInput::make('code')
                                ->required()
                                ->maxLength(255),
                            Textarea::make('description')
                                ->columnSpanFull(),
                            Textarea::make('summary')
                                ->columnSpanFull(),
                        ]),
                    Fieldset::make('Additional Information')
                        ->schema([
                            Select::make('categories')
                                ->searchable()
                                ->preload()
                                ->createOptionForm(Category::getForm())
                                ->editOptionForm(Category::getForm())
                                ->relationship('categories', 'name')
                                ->multiple(),
                            FileUpload::make('image')
                                ->image(),
                            TextInput::make('duration')
                                ->maxLength(255),
                            TextInput::make('requirement')
                                ->maxLength(255),
                            ToggleButtons::make('status')
                                ->live()
                                ->inline()
                                ->options(ContentStatus::class)
                                ->default(ContentStatus::PUBLISHED->value)
                                ->required(),
                        ]),
                    Fieldset::make('Relationships')
                        ->schema([
                            Select::make('instructors')
                                ->searchable()
                                ->preload()
                                ->relationship('instructors', 'id')
                                ->options(function () {
                                    return Instructor::query()
                                        ->with('user:id,name') // Eager load the user relationship
                                        ->get()
                                        ->pluck('user.name', 'id'); // Pluck user name and instructor ID
                                })
                                ->multiple(),
                        ])
                ])
        ];
    }
}
