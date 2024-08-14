<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\UserRole;
use App\Enums\UserStatus;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Get;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'country_code',
        'mobile_number',
        'status',
        'role',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->role === UserRole::SUPER_ADMIN->value && $this->hasVerifiedEmail();
    }

    public function instructor(): HasOne
    {
        return $this->hasOne(Instructor::class);
    }

    public function student(): HasOne
    {
        return $this->hasOne(Student::class);
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($user) {
            if (empty($user->password)) {
                $user->password = bcrypt(Str::random(8)); // Generate a random 8-character password and hash it
            }
        });
    }

    public static function getForm(): array
    {
        return [
            Section::make('User Information')
                ->columns(2)
                ->schema([
                    Fieldset::make('Basic Information')
                        ->schema([
                            FileUpload::make('avatar')
                                ->columnSpanFull()
                                ->avatar()
                                ->directory('avatars')
                                ->preserveFilenames()
                                ->imageEditor()
                                ->maxSize(1024 * 1024 * 10),
                            TextInput::make('username')
                                ->maxLength(255),
                            TextInput::make('name')
                                ->required()
                                ->maxLength(255),
                            TextInput::make('email')
                                ->email()
                                ->required()
                                ->maxLength(255),
                        ]),
                    Fieldset::make('Contact Information')
                        ->schema([
                            TextInput::make('country_code')
                                ->maxLength(3),
                            TextInput::make('mobile_number')
                                ->maxLength(255),
                        ]),
                    Fieldset::make('Additional Information')
                        ->schema([
                            Tabs::make('Role And Status')
                                ->columnSpanFull()
                                ->tabs([
                                    Tabs\Tab::make('Role')
                                        ->schema([
                                            ToggleButtons::make('role')
                                                ->live()
                                                ->inline()
                                                ->options(UserRole::class)
                                                ->default(UserRole::SUPER_ADMIN->value)
                                                ->required(),
                                        ]),
                                    Tabs\Tab::make('Status')
                                        ->schema([
                                            ToggleButtons::make('status')
                                                ->live()
                                                ->inline()
                                                ->options(UserStatus::class)
                                                ->default(UserStatus::ENABLED->value)
                                                ->required(),
                                        ]),
                                ])
                        ]),
                    Fieldset::make('Credential Control')
                        ->hidden(fn(User $user, Get $get) => $get('role') === 'STUDENT')
                        ->schema([
                            TextInput::make('password')
                                ->password()
                                ->required()
                                ->maxLength(255),
                            TextInput::make('password_confirmation')
                                ->password()
                                ->required()
                                ->maxLength(255)
                                ->same('password')
                                ->label('Confirm Password'),
                        ]),

                ]),
        ];
    }
}
