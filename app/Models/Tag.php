<?php

namespace App\Models;

use App\Http\Controllers\TodoController;
use App\Http\Controllers\TaskController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'tag'
    ];
    public function todos() {
        return $this->hasMany('App\Models\Todo');
    }
}
