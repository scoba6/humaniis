<?php

namespace App\Models;

use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Option extends Model
{
    use HasFactory, SoftDeletes, Userstamps;

    //Options pour les formules
    protected $table = 'formule_options';

    protected $fillable = [
        
        'formule_id',
        'sexgrp_id',
        'libopt',
        'agemin',
        'agemin',
        'agemax',
        'mntxaf',
        'mnteur',
        'mntopx',
        'mntope',
        'mntdnx',
        'mntdne',
        'dtlopt'

     ];

     /**
      * Get the formule that owns the Option
      *
      * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
      */
     public function formule(): BelongsTo
     {
         return $this->belongsTo(Formule::class);

     }

   /**
    * Get the sexgrp that owns the Option
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function sexgrp(): BelongsTo
   {
       return $this->belongsTo(SexGrp::class,'sexgrp_id','id');
   }
    



}
