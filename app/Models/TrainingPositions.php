<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingPositions extends Model
{
    protected $table = 'training_positions';

    protected $fillable = [
        'id', 'pharmacy_id', 'title', 'is_visible', 'last_apply_date'
    ];

}
