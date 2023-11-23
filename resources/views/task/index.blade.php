<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laravel Task Project</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
</head>

@php
use Illuminate\Support\Str;
use App\Enums\StatusEnum;
use App\Models\Task;
@endphp
<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Laravel TODO Task Project</h2>
                </div>
                <div class="pull-right mb-2">
                    <a class="btn btn-success" href="{{ route('tasks.create') }}"> Create Task</a>
                </div>
            </div>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <table class="table table-bordered" id="yourTable">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Title</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $index => $task)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->name }}</td>
                        <td>{{ $task->release_date }}</td>
                        <td>{{ $task->description }}</td>
                         <td>
                            @if($task->status==1)
                            <a href="{{ url('change-status/'.$task->id) }}" onclick="return confirm('Are you Sure?')" class="btn btn-success badge bg-outline-success">Complete</a>
                            @else
                            <a href="{{ url('change-status/'.$task->id) }}" onclick="return confirm('Are you Sure?')" class="btn btn-danger badge bg-outline-danger">InComplete</a>
                            @endif
                          </td>
                         <td>
                            <form method="POST" action="{{ route('tasks.destroy', $task->id) }}">
                                @method('DELETE')
                                @csrf
                                <a class="btn btn-primary badge bg-outline-danger" href="{{ route('tasks.edit',$task->id) }}">Edit</a>

                                <button class="btn btn-danger badge bg-outline-danger" onclick="return confirm('Are you sure?'); event.preventDefault();
                                this.closest('form').submit();"><em class="icon ni ni-trash"></em>
                                    Delete</a>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
        {!! $tasks->links() !!}
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>

</body>
</html>
