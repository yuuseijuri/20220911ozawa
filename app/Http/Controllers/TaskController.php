<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\ClientRequest;
use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use App\Models\User;
use App\Models\Tag;
use App\Http\Controllers\TodoController;

class TaskController extends Controller
{
    public function find() {
        $auth = Auth::user();
        $users = User::all();
        $todos = Todo::all();
        $tags = Tag::all();
        $param = [
            'auth' => $auth,
            'user' => $users,
            'todos' => $todos,
            'tags' => $tags
        ];
        return view('find', $param, ['input' => '']);
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
    public function update(TodoRequest $request) {
        $user_id = Auth::id();
        $task = $request->task;
        $tag_id = $request->tag_id;
        
        $form = [
            'user_id' => $user_id,
            'task' => $task,
            'tag_id' => $tag_id
        ];
        
        unset($form['_token']);
        Todo::where('id', $request->id)->update($form);
        return redirect('/find');
    }
    public function remove(Request $request) {
        Todo::find($request->id)->delete();
        return redirect('/find');
    }
}
