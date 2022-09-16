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
      $param = [
        'auth' => $auth,
        'user' => $users,
        'todos' => $todos
      ];
      return view('index', $param);
    }
    public function create(TodoRequest $request) {
      $user_id = Auth::id();
      $task = $request->task;
      $tag_id = $request->tag_id;
      $form = [
        'user_id' => $user_id,
        'task' => $task,
        'tag_id' => $tag_id
      ];
      Todo::create($form);
      return redirect('/home');
    }
    public function update(TodoRequest $request) {
      $form = $request->all();
      unset($form['_token']);
      User::where('id', $request->id)->update($form);
      return redirect('/');
    }
    public function remove(TodoRequest $request) {
      $id = User::id();
      $email = $request->email;
      $password = $request->password;
      $form = [
        'id' => $id,
        'email' => $email,
        'password' => $password
      ];
      User::find($form)->delete();
      return redirect('/home');
    }
}
