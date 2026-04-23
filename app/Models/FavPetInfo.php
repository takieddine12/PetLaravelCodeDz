<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FavPetInfo extends Model
{
    protected $table = 'favPetInfo';

    public $timestamps = false;

    protected $primaryKey = 'petID'; 

    public $incrementing = false;

    protected $keyType = 'string'; 

    protected $fillable = [
        'petID',
        'petCategory',
        'petBreed',
        'gender',
        'age',
        'city',
        'status',
        'description',
        'petName',
        'image', 
        'isAdded'
    ];


}