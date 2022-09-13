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
    display: flex;
    justify-content: flex-start;
  }
  .header_list {
    display: flex;
  }
  h1 {
    width: 25vw;
    font-size: 24px;
    margin: 5px 0 0 0;
  }
  .header_list p {
    margin: 12px 15px 0 0px;
  }
  .logout_btn {
    padding: 8px 10px;
    border: 2px solid red;
    border-radius: 5px;
    color: red;
    background-color: white;
  }
  .logout_btn:hover {
    color: white;
    background-color: red;
  }
  .task_btn {
    padding: 8px 10px;
    margin-top: 10px;
    border: 2px solid #FFD700;
    border-radius: 5px;
    color: #FFD700;
    background-color: white;
  }
  .task_btn:hover {
    color: white;
    background-color: #FFD700;
  }
  .content {
    width: 100%;
    display: flex;
    justify-content: flex-start;
  }
  .task_text {
    width: 36vw;
    padding: 8px 10px;
    margin-top: 5px;
    border: 1px solid #A9A9A9;
    border-radius: 5px;
  }
  .tag_list {
    padding: 10px;
    border: 1px solid #A9A9A9;
    border-radius: 5px;
    margin-left: 25px;
  }
  .create_btn {
    padding: 8px 18px;
    border: 2px solid #FF00FF;
    border-radius: 5px;
    color: #FF00FF;
    background-color: white;
    margin-left: 25px;
  }
  .create_btn:hover {
    color: white;
    background-color: #FF00FF;
  }
  .title_list {
    width: 100%;
    margin-top: 20px;
    font-size: 18px;
  }
  .list1, .list2 {
    width: 35%;
    text-align: center;
  }
  .list3, .list4, .list5 {
    width: 10%;
    text-align: center;
  }
  .text1, .text2 {
    width: 35%;
    text-align: center;
  }
  .text3, .text4, .text5 {
    width: 10%;
    text-align: center;
  }
  .update_btn {
    padding: 8px 18px;
    border: 2px solid #FF8C00;
    border-radius: 5px;
    color: #FF00FF;
    background-color: white;
    margin-left: 25px;
  }
  .update_btn:hover {
    color: white;
    background-color: #FF8C00;
  }
  .remove_btn {
    padding: 8px 18px;
    border: 2px solid #00FFFF;
    border-radius: 5px;
    color: #FF00FF;
    background-color: white;
    margin-left: 25px;
  }
  .remove_btn:hover {
    color: white;
    background-color: #00FFFF;
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
            <input type="submit" value="ログアウト" class="logout_btn">
          </form>
        </div>
      </div>
      <form action="/find" method="get">
        @csrf
        <input type="submit" value="タスク検索" class="task_btn">
      </form>
      <div class="content" style="display:inline-flex">
        <form action="/add" method="post">
          @csrf
          <input type="text" name="task" value="{{$auth->task}}" class="task_text">
        </form>
        <form action="detail.html" method="post">
          @csrf
          <select name="select" class="tag_list">
            <option value="家事">家事</option>
            <option value="勉強">勉強</option>
            <option value="運動">運動</option>
            <option value="食事">食事</option>
            <option value="移動">移動</option>
          </select>  
        </form>
        <form action="/edit" method="post">
          @csrf
          <input type="submit" value="追加" class="create_btn">
        </form>  
      </div>
      <table class="title_list">
        <tr>
          <th class="list1">作成日</th>
          <th class="list2">タスク名</th>
          <th class="list3">タグ</th>
          <th class="list4">更新</th>
          <th class="list5">削除</th>
        </tr>
        @foreach($todos as $todo)
        <tr>
          <td class="text1">{{$auth->updated_at}}</td>
          <form action="{{route('edit', ['id' => $todo->id])}}" method="post">
            @csrf
            <td class="text2">
              <input type="text" name="task" value="{{$todo->task}}">
            </td>
          </form>
          <form action="detail.html" method="get">
            @csrf
            <td class="text3">
              <select name="select" class="tag_list">
                <option value="家事">家事</option>
                <option value="勉強">勉強</option>
                <option value="運動">運動</option>
                <option value="食事">食事</option>
                <option value="移動">移動</option>
              </select> 
            </td> 
          </form>
          <form action="/edit" method="post">
            @csrf
            <td class="text4">
              <input type="submit" value="更新" class="update_btn">
            </td>
          </form>  
          <form action="/delete" method="post">
            @csrf
            <td class="text5">
              <input type="submit" value="削除" class="remove_btn">
            </td>
          </form>  
        </tr>
      </table>
    </div>
  </div>
</body>
</html>