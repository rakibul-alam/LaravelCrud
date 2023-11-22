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

        <table class="table table-bordered">
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
                            <div class="custom-control custom-switch status-change"
                            data-value="{{ $task->status == StatusEnum:: Active->value ? StatusEnum:: Inactive->value : StatusEnum:: Active->value }}"
                            data-url="{{route('update.task-status',$task->id)}}">
                            <input type="checkbox" class="custom-control-input" id="customSwitch{{$index + 1}}"
                                {{ $task->status == StatusEnum::Active->value ? 'checked' : '' }} name='input_switch'>
                            <label class="custom-control-label" for="customSwitch{{$index + 1}}"></label>
                        </div>
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
                        </td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
        {!! $tasks->links() !!}
    </div>

    <script>
        taskStatus();

        function taskStatus() {
            $btnDestroy = $('.status-change');
            $btnDestroy.on('click', function() {
                // alert('dfsf');
                swal({
                    title: "Want to " + $(this).data('value') + " this?",
                    icon: "warning",
                    type: "warning",
                    buttons: ["Cancel", "Yes!"],
                    confirmButtonColor: '#0ac282',
                    cancelButtonColor: '#fe5d70',
                    confirmButtonText: 'Yes, confirm it!'
                }).then((confirm) => {
                    if (confirm) {
                        $.ajax({
                            url: $(this).data('url'),
                            type: 'post',
                            data: {
                                '_token': '{{ csrf_token() }}',
                                '_method': 'PATCH',
                            },
                            success: function(data) {
                                if (data.redirect == true) {
                                    return window.location.replace(data.route);
                                }
                            },
                            error: function() {}
                        });
                    } else {
                        let input = this.querySelector('input[name=input_switch]');
                        if (input.checked) {
                            input.checked = false;
                        } else {
                            input.checked = true;
                        }
                    }
                });
            });
        }
        </script>

</body>
</html>
