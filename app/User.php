<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'hp', 'institusi_id', 'nik', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relation with institusi
     */
    public function institusi()
    {
        return $this->hasOne('App\Models\Instititusi', 'id', 'institusi_id');
    }

    public static function getValidationRules()
    {
        $rules = [
            'hp' => 'required|unique:user,hp',
            'institusi_id' => 'required',
            'nik' => 'required',
            'password' => 'required',
        ];

        return $rules;
    }
}
