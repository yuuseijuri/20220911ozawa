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
      $form = $request->all();
      User::create($form);
      return redirect('/');
    }
    public function update(TodoRequest $request) {
      $form = $request->all();
      unset($form['_token']);
      User::where('id', $request->id)->update($form);
      return redirect('/');
    }
    public function remove(Request $request) {
      User::find($request->id)->delete();
      return redirect('/');
    }
}
