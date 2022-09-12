<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Todo List</title>
  <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
  <style>
  .container {
    width: 100vw;
    height: 100vh;
    background-color: #0000CD;
    position: relative;
  }
  .main {
    width: 50vw;
    padding: 30px;
    background-color: white;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    border-radius: 10px;
  }
  .header {
    width: 100%;
    padding: 5px;
    background-color: #40E0D0;
  }
  h1 {
    font-size: 24px;
  }
  p {
    margin-top: 5px;
    
  }
  .logout {
    
  }
  </style>
</head>
  <body>
  <div class="container">
    <div class="main">
      <div class="header">
        <h1>Todo List</h1>
        @if(Auth::check())
        <p>「{{ $auth->name }}」 でログイン中</p>
        @endif 
        @if(count($errors) > 0)
        <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
        </ul>
        @endif
        <form action="/" method="get">
          @csrf
          <input type="submit" value="ログアウト" class="logout">
        </form>
      </div>
    </div>
  </div>
  </body>
</html>

