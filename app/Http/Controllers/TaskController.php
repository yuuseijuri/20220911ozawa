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
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Middleware\Authenticate;

class TaskController extends Controller
{
    public function find() {
        $auth = Auth::user();
        $tags = Tag::all();
        $param = [
            'auth' => $auth,
            'tags' => $tags,
        ];
        return view('find', $param);
    }
    public function search(Request $request) {
        $auth = Auth::user();
        $tags = Tag::all();
        // $todos = Todo::all();
        $todos = Todo::where('task', $request->task)->get();
        // $todos = Todo::where('tag_id',$request->tag_id)->get();
        $param = [
            'auth' => $auth,
            'tags' => $tags,
            'todos' => $todos,
            // 'tasks' => $tasks,
        ];
        dd($param);
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
        Todo::find($request->id)->taskDelete();
        return redirect('/find');
    }
}
