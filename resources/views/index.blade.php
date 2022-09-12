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
    width: 50%;
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
    display: flex;
    justify-content: flex-start;
  }
  .header_list {
    display: flex;
  }
  h1 {
    font-size: 24px;
    margin: 5px 150px 0 0;
  }
  .header_list p {
    margin: 10px 15px 0 150px;
  }
  .logout {
    padding: 5px 10px;
    border: 2px solid red;
    border-radius: 5px;
    color: red;
    background-color: white;
    cursor: pointer;
    transition: .2s cubic-bezier(0.45, 0, 0.55, 1);
  }
  .logout.reverse:hover {
    color: white;
    background-color: red;
  }
  </style>
</head>
  <body>
  <div class="container">
    <div class="main">
      <div class="header">
        <h1>Todo List</h1>
        <div class="header_list">
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
  </div>
  </body>
</html>

