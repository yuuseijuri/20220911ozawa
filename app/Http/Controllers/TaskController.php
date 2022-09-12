<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\ClientRequest;
use App\Http\Requests\TodoRequest;
use App\Models\Todo;

class TaskController extends Controller
{
    public function find() {
        return view('find', ['input' => '']);
    }
    public function search(Request $request) {
        $todos = Todo::where($request->input)->task();
        $todos = Todo::where($request->tag_id)->tag();
        $param = [
            'todos' => $todos,
            'input' => $request->input
        ];
        return view('find', $param);
    }
}
