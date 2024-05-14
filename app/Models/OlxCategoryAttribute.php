<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OlxCategoryAttribute extends Model
{
    use HasFactory;


    protected $guarded = [];
    protected $casts = [
        'required' => 'boolean',
        'allow_multiple_values' => 'boolean',
    ];
}
