<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Todo-List</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <style>
        .fa-btn {
            margin-right: 6px;
        }

        table button {
            margin-left: 20px
        }
    </style>
</head>
<body id="app-layout">

<div id="modifyModel" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body">
                <form id="modifyForm">
                    @csrf
                    <label for="name">name</label>
                    <input type="text" name="name" class="form-control" id="modifyDataName">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" onclick="sendModify()">Submit</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">

            <!-- Branding Image -->
            <a class="navbar-brand" href="">
                Task List
            </a>
        </div>
    </div>
</nav>
<div class="container">
    <div class="col-sm-offset-2 col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                New Task
            </div>

            <div class="panel-body">
                <!-- New Task Form -->
                <form action="" method="POST" class="form-horizontal">
                    @csrf
                    <!-- Task Name -->
                    <div class="form-group">
                        <label for="task-name" class="col-sm-3 control-label">Task</label>

                        <div class="col-sm-6">
                            <input type="text" name="name" id="task-name" class="form-control" value="">
                        </div>
                    </div>

                    <!-- Save Button -->
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                            <button type="submit" class="btn btn-default" >
                                <i class="fa fa-btn fa-plus"></i>Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Current Tasks -->
        <div class="panel panel-default">
            <div class="panel-heading">
                Current Tasks
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">
                    <thead>
                        <th>Task</th>
                        <th>&nbsp;</th>
                    </thead>
                    <tbody>
                    @foreach( $data as $row)
                    <tr>
                        <td class="col-sm-6">
                            <del>{{ $row->name }}</del>
                        </td>
                        <!-- Task Buttons -->
                        <td class="col-sm-6">
                            <button type="submit" class="btn btn-success" ><i class="fa fa-btn fa-thumbs-o-up"></i>completed</button>
                            <button type="button" class="btn btn-primary" onclick="showModifyModel( {{ $row->id }},'{{ $row->name }}')" ><i class="fa fa-btn fa-pencil" ></i>edit</button>
                            <button type="button" class="btn btn-danger" onclick="sendDelete({{ $row->id }})"><i class="fa fa-btn fa-trash"></i>delete</button>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var pk;

    function showModifyModel( primaryKey , dataName) {
        $('#modifyModel').modal('show');
        $('#modifyDataName').val(dataName);
        pk = primaryKey;
    }

    function sendModify(){
        $.ajax({
            url : "{{ url('modify') }}/"+pk,
            method: "post",
            data: $('#modifyForm').serialize(),
            success: function(){
                alert("success");
                location.reload();
            }
        })
    }

    function sendDelete(pk){
        if (confirm("Are You Sure")){
            $.ajax({
                url : "{{ url('delete') }}/"+pk,
                success: function(){
                    alert("success");
                    location.reload();
                }
            })
        }
    }
</script>
</body>
</html>