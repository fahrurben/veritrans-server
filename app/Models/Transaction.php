<?php
/**
 * Created by PhpStorm.
 * User: fahrur
 * Date: 15/03/20
 * Time: 17:43
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transaction';

    protected $fillable = [
        'user_id',
        'bank_id',
        'date',
        'amount',
        'status',
    ];

    protected $appends = ['status_name', 'bank_name'];

    /**
     * Relation with user
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Relation with bank
     */
    public function bank()
    {
        return $this->hasOne('App\Models\Bank', 'id', 'bank_id');
    }

    public function getStatusNameAttribute(){
        $status_name = '';
        if ($this->status == 0) $status_name = 'Sedang diverifikasi';
        else if ($this->status == 1) $status_name = 'Terverifikasi';
        else if ($this->status == -1) $status_name = 'Gagal diverifikasi';

        return $status_name;
    }

    public function getBankNameAttribute()
    {
        return $this->bank->name;
    }

    public static function getValidationRules()
    {
        $rules = [
            'user_id' => 'required',
            'bank_id' => 'required',
            'date' => 'required',
            'amount' => 'required',
        ];

        return $rules;
    }
}