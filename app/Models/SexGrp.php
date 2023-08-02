<?php

namespace App\Models;

use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;

class SexGrp extends Model
{
    use HasFactory, Userstamps, SoftDeletes;

    protected $table = 'sexgrp';

    protected $fillable = [
        'libsxg'
    ];

  /**
   * Get the categorie associated with the SexGrp
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasOne
   */
  public function categorie(): HasOne
  {
      return $this->hasOne(Option::class, 'id','sexgrp_id');
  }
}
