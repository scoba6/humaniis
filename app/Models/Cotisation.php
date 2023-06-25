<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Cotisation extends Model
{
    use HasFactory, SoftDeletes, Userstamps;

    protected $table = 'cotisations';

    protected $fillable = [
        'mntcot',
        'membre_id',
        'datcot',
        'detcot'
     ];
}
