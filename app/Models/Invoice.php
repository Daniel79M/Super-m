<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_number' ,
    ];

    protected $with = [
        'sale',
    ];

    public function sales(): HasMany
    {
        return $this->hasMany(
            related: sale::class,
        );
    }
}
