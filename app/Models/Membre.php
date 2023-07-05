<?php

namespace App\Models;

use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Membre extends Model
{
    use HasFactory, Userstamps, SoftDeletes;

    protected $table = 'famille_membres';

    protected $fillable = [
        'famille_id',
        'qualite_id',
        'formule_id',
        'sexmem_id',
        'nommem',
        'datnai',
        'commem',
        'agemem',
        'commem'

     ];


    /**
     * Get the famille that owns the Membre
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function famille(): BelongsTo
    {
        return $this->belongsTo(Famille::class, 'fammile_id', 'id');
    }

    /**
     * Get the qualite that owns the Membre
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function qualite(): BelongsTo
    {
        return $this->belongsTo(Qualite::class);
    }

    /**
     * Get the formule that owns the Membre
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function formule(): BelongsTo
    {
        return $this->belongsTo(Formule::class);
    }

    /**
     * Get all of the cotisations for the Membre
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cotisations(): HasMany
    {
        return $this->hasMany(Cotisation::class);
    }


    
}
