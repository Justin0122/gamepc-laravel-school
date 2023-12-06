<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class visitors extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip',
        'browser',
        'time',
        'numberOfVisits'
    ];

    protected $table = 'visitors';

    public $timestamps = true;
}
