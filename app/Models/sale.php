<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sale extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
<<<<<<< Updated upstream
        'name',
        'price',
        'quantity',
        'total',
        'fulltotal',
=======
        'entire',
>>>>>>> Stashed changes
    ];
}
