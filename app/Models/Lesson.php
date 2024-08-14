<?php

namespace App\Models;

use App\Enums\ContentStatus;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'subtitle',
        'content',
        'status',
        'image',
    ];

    public function course(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public static function getForm(): array
    {
        return [
            Section::make('Lesson Information')
                ->columns(2)
                ->schema([
                    Select::make('course_id')
                        ->relationship('course', 'name'),
                    TextInput::make('title')
                        ->maxLength(255),
                    TextInput::make('subtitle')
                        ->maxLength(255),
                    TextInput::make('content')
                        ->columnSpanFull(),
                    ToggleButtons::make('status')
                        ->live()
                        ->inline()
                        ->options(ContentStatus::class)
                        ->default(ContentStatus::PUBLISHED->value)
                        ->required(),
                ]),
        ];
    }
}
