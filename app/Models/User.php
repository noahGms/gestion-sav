<?php

namespace App\Models;

use App\Traits\HasFullName;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use HasFullName;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'firstname',
        'lastname',
        'password',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_god' => 'boolean',
    ];

    /**
     * @param array $details
     * @return $this
     */
    public function createGodUser(array $details): self
    {
        $user = new self($details);

        if ($this->usernameExists($details['username'])) throw new \Error('Username already exists');
        if ($this->godExists()) throw new \Error('God already exists');

        $user->is_god = true;
        $user->save();

        return $user;
    }

    /**
     * @param $username
     * @return int
     */
    public function usernameExists($username): int
    {
        return self::where('username', '=', $username)->count();
    }

    /**
     * @return int
     */
    public function godExists(): int
    {
        return self::where('is_god', true)->count();
    }

    /**
     * @param $password
     * @return void
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }
}
