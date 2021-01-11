<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class countries extends Model
{
    use HasFactory;

        /**
     * The database table used by the model.
     *
     * @var string
     */

    protected $table = 'countries';

    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    protected $fillable = [

        'code','name','cases','death','recovered','today_cases','today_death','today_recovered','active','mild','critical','update'

    ];
}
