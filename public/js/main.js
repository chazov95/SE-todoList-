$(document).ready(function () {
    $('button.addTask').on('click', function () {
        let title = $('#title').val();
        let body = $('#body').val();

        $.ajax({
            method: "POST",
            url: "api/addTask",
            data: {title: title, body: body, "_token": $('meta[name="csrf-token"]').attr('content')}
        })
            .done(function (data) {
                let lastTask = "<li id='task_"+data.id +"'>" + data.id + " " + data.title + " " + data.body + " "+
                    "<button onclick=\"deleteTask("+ data.id+")\" type=\"button\"" +
                    " class=\"close btn btn-sm btn-outline-secondary\" aria-label=\"Close\">" +
                    "<span aria-hidden=\"true\">&times;</span></button>" + "</li>";
                $("#taskList").append(lastTask);
                document.getElementById("title").value = "";
                document.getElementById("body").value = "";
            });
    })
})

function deleteTask(taskId) {
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this imaginary file!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    method: "DELETE",
                    url: "api/task/" + taskId,
                    data: {"_token": $('meta[name="csrf-token"]').attr('content')}
                });
                $('#task_' + taskId).hide();
            }
        });
}
