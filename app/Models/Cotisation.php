<?php

namespace App\Models;

use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cotisation extends Model
{
    use HasFactory, SoftDeletes, Userstamps;

    protected $table = 'cotisations';

    protected $fillable = [
        'mntcot',
        'membre_id',
        'datcot',
        'datval',
        'detcot'
    ];


    /**
     * Get the membre that owns the Cotisation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function membre(): BelongsTo
    {
        return $this->belongsTo(Membre::class);
    }
}
