<?php

namespace App\Models;

use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Famille extends Model
{
    use HasFactory, Userstamps, SoftDeletes;

    protected $table = 'familles';

    protected $fillable = [
       'matfam',
       'nomfam',
       'vilfam',
       'payfam',
       'adrfam'
    ];
}
