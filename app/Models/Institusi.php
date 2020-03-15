<?php
/**
 * Created by PhpStorm.
 * User: fahrur
 * Date: 15/03/20
 * Time: 9:48
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Institusi extends Model
{
    use SoftDeletes;

    protected $table = 'institusi';

    protected $fillable = [
        'name',
    ];
}