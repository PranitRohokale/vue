<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $fillable = [
        'title',
        'description',
        'isComplete',
        'complexity',
        'updated_at',
        'created_at',
    ];

}
