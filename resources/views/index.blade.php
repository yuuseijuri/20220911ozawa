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
    background-color: #000080;
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
  .list1 {
    width: 30%;
    text-align: center;
  }
  .list2 {
    width: 40%;
    text-align: center;
  }
  .list3, .list4, .list5 {
    width: 10%;
    text-align: center;
  }
  .text1 {
    width: 30%;
    text-align: center;
    font-size: 16px;
  }
  .text2 {
    width: 40%;
    text-align: center;
    font-size: 16px;
  }
  .task_text2 {
    width: 80%;
    padding: 8px 10px;
    margin-top: 5px;
    border: 1px solid #A9A9A9;
    border-radius: 5px;
  }
  .text3, .text4, .text5 {
    width: 10%;
    text-align: center;
  }
  .update_btn {
    padding: 8px 18px;
    border: 2px solid #FF8C00;
    border-radius: 5px;
    color: #FF8C00;
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
    color: #00FFFF;
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
          <p>???{{ $auth->name }}??? ??????????????????</p>
          @endif 
          @if(count($errors) > 0)
          <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
          </ul>
          @endif
          <form action="/logout" method="get">
            @csrf
            <input type="submit" value="???????????????" class="logout_btn">
          </form>
        </div>
      </div>
      <form action="/find" method="get">
        @csrf
        <input type="submit" value="???????????????" class="task_btn">
      </form>
      <div class="content">
        <form action="/add" method="post" style="display:inline-flex">
          @csrf
          <input type="text" name="task" class="task_text">
          @csrf
          <select name="tag_id" class="tag_list">
            @foreach($tags as $tag)
              <option value="{{$tag->id}}">{{$tag->tag}}</option>
            @endforeach
          </select>   
          @csrf
          <input type="submit" value="??????" class="create_btn">
        </form>  
      </div>
      <table class="title_list">
        <tr>
          <th class="list1">?????????</th>
          <th class="list2">????????????</th>
          <th class="list3">??????</th>
          <th class="list4">??????</th>
          <th class="list5">??????</th>
        </tr>
        @foreach($todos as $todo)
        <tr>
          <td class="text1">{{$todo->updated_at}}</td>
          <form action="{{route('edit', ['id' => $todo->id])}}" method="post">
            @csrf
            <td class="text2">
              <input type="text" name="task" value="{{$todo->task}}" class="task_text2">
            </td>
            @csrf
            <td class="text3">
              <select name="tag_id" class="tag_list">
                @foreach($tags as $tag)
                  <option value="{{$tag->id}}" @if($tag->id==$todo->tag_id) selected @endif>{{$tag->tag}}</option>
                @endforeach
              </select>   
            </td> 
            @csrf
            <td class="text4">
              <input type="submit" value="??????" class="update_btn">
            </td>
          </form>  
          <form action="{{route('delete', ['id' => $todo->id])}}" method="post">
            @csrf
            <td class="text5">
              <input type="submit" value="??????" class="remove_btn">
            </td>
          </form>  
        </tr>
        @endforeach
      </table>
    </div>
  </div>
</body>
</html>