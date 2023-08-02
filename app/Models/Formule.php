<?php

namespace App\Models;

use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Formule extends Model
{
    use HasFactory, SoftDeletes, Userstamps;

    protected $fillable = [
        //'territo_id',
        'libfrm',
        'comfrm',
        'ambfrm'

    ];

    /**
     * Get all of the 
     * Options for the Formule
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function options(): HasMany
    {
        return $this->hasMany(Option::class);
    }

    
}
