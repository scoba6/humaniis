<?php

namespace App\Models;

use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;

class Famille extends Model
{
    use HasFactory, Userstamps, SoftDeletes;

    protected $table = 'familles';

    protected $fillable = [
       'matfam',
       'nomfam',
       'vilfam',
       'payfam',
       'adrfam',
       'commercial_id'
    ];


    /**
     * Get all of the membres for the Famille
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function membres(): HasOneOrMany
    {
        return $this->hasMany(Membre::class, 'famille_id', 'id');
    }

    /**
     * Get the commercial that owns the Famille
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function commercial(): BelongsTo
    {
        return $this->belongsTo(Commercial::class);
    }
}
