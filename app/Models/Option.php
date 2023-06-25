<?php

namespace App\Models;

use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Option extends Model
{
    use HasFactory, SoftDeletes, Userstamps;

    //Options pour les formules
    protected $table = 'formule_options';

    protected $fillable = [
        '',
        'libopt',
        'agemin',
        'agemin',
        'agemax',
        'mntxaf',
        'mnteur',
        'dtlopt'

     ];

    



}
