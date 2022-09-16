<?php

namespace App\Models;

use App\Http\Controllers\TaskController;
use App\Http\Controllers\TodoController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = [
        'task',
        'tag_id',
        'user_id'
    ];
}
