<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.js"
            integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <title></title>

</head>
<body>
<div class="container">


    <div class="row">
        <div class="col"><h1> TODO LIST</h1>

            <input type="text" id="title" name="title" placeholder="Введите название задачи"> <br/>
            <textarea id="body" class="body" placeholder="Введите текст задачи"></textarea><br/>
            <button class="addTask" type="submit">Добавить задачу</button>
        </div>
        <div id="taskList" class="col">
            @foreach ($tasks as $task)
                <li id="task_{{ $task->id }}">{{ $task->id }} {{ $task->title }} {{ $task->body }}
                    <button onclick="deleteTask({{ $task->id }})" type="button" class="close" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </li>
            @endforeach

        </div>
    </div>
</div>
<script>

    $(document).ready(function () {
        $('button.addTask').on('click', function () {
            let title = $('#title').val();
            let body = $('#body').val();

            $.ajax({
                method: "POST",
                url: "api/addTask",
                data: {title: title, body: body, "_token":  $('meta[name="csrf-token"]').attr('content')}
            })
                .done(function (data) {
                    let lastTask = "<li>" + data.id + " " + data.title + " " + data.body + "</li>";
                    $("#taskList").append(lastTask);
                });
        })
    })
    function deleteTask(taskId){
        $.ajax({
            method: "DELETE",
            url: "api/task/"+taskId,
            data: {"_token":  $('meta[name="csrf-token"]').attr('content')}
        });
        $('#task_'+taskId).hide();
    }
</script>

</body>
</html>
