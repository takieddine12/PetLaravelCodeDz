<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PetInfo extends Model
{
    protected $table = 'petInfo';

    protected $primaryKey = 'petID'; // ✅ ADD THIS

    public $incrementing = false; // ✅ ADD THIS (since it's not auto increment)

    protected $keyType = 'string'; // ✅ ADD THIS (because petID is string)

    public $timestamps = false;

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
        'isAdded',
        'userID',
        'phoneNumber',
        'email',
        'latitude',
        'longitude',
    ];
}