<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vaccination extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */

    protected $table = 'vaccinations';

    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    protected $fillable = [

        'location','date','vaccine','total_vaccinations'

    ];
}
