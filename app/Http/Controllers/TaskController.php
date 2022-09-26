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
        $task = $request->input('task');
        $tag_id = $request->input('tag_id');

        $query = Todo::query();
        
        if(isset($task)) {
            $query->where('task', 'LIKE BINARY', "%{$request->task}%");
        }
        if(isset($tag_id)) {
            $query->where('tag_id',$request->tag_id);
        }
        $todos = $query->get();
        // dd($todos);
        $param = [
            'auth' => $auth,
            'tags' => $tags,
            'task' => $task,
            'tag_id' => $tag_id,
            'todos' => $todos,
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
