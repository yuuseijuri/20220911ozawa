<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\ClientRequest;
use App\Http\Requests\TodoRequest;
use App\Models\User;
use App\Models\Todo;
use App\Models\Tag;
use App\Http\Controllers\TaskController;

class TodoController extends Controller
{
    public function index() {
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
      return view('index', $param);
    }
    public function create(TodoRequest $request) {
      $user_id = Auth::id();
      $todos = Todo::all();
      $tags = Tag::all();
      $task = $request->task;
      $tag_id = $request->tag_id;
      $form = [
        'user_id' => $user_id,
        'todos' => $todos,
        'tags' => $tags,
        'task' => $task,
        'tag_id' => $tag_id,
      ];
      Todo::create($form);
      return redirect('/home');
    }
    public function update(TodoRequest $request) {
      $user_id = Auth::id();
      $todos = Todo::all();
      $tags = Tag::all();
      $task = $request->task;
      $tag_id = $request->tag_id;
      $form = [
        'user_id' => $user_id,
        'todos' => $todos,
        'tags' => $tags,
        'task' => $task,
        'tag_id' => $tag_id,
      ];
      unset($form['_token']);
      User::where('id', $request->id)->update($form);
      return redirect('/');
    }
    public function remove(TodoRequest $request) {
      
      User::find($request->id)->delete();
      return redirect('/home');
    }
}
