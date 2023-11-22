<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Edit Task</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary badge bg-outline-danger" href="{{ route('tasks.index') }}" enctype="multipart/form-data">
                        Back</a>
                </div>
            </div>
        </div>
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
        @endif
        <form action="{{ route('tasks.update',$task->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">

                    <div class="form-group">
                        <strong>Title:</strong>
                        <input type="text" name="title" class="form-control" placeholder="Company Email"
                            value="{{ $task->title }}">
                        @error('title')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                        <strong>Name:</strong>
                        <input type="text" name="name" value="{{ $task->name }}" class="form-control"
                            placeholder="Company name">
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Description</strong>
                        <input type="text" name="description" value="{{ $task->description }}" class="form-control"
                            placeholder="description">
                        @error('description')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Date</strong>
                        <input type="date" name="release_date" value="{{ $task->release_date }}" class="form-control"
                            placeholder="date">
                        @error('date')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary ml-3">Submit</button>
            </div>
        </form>
    </div>


<script>

// Ajax modal
function ajaxModal() {
    let $ajaxModalTrigger = $('.ajax-modal-trigger'),
        $modal = $('#ajax-modal');

    $ajaxModalTrigger.on('click', function() {
        $.get($(this).data('route'), {}, function(data) {
            // console.log(data);
            $modal.html(data);
            $modal.modal('show');
        });
    });
}

// ajax form submit
function ajaxFormSubmit() {
    let $ajaxForm = $('.ajax-form'),
        $validation = $('.validation');

    $ajaxForm.on('submit', function(e) {
        e.preventDefault();
        $.ajax($(this).attr('action'), {
            method: 'post',
            processData: false,
            contentType: false,
            data: new FormData($(this)[0])
        }).done(function(data) {
            if (data.redirect == true) {
                return window.location.replace(data.route);
            }
            // location.reload();
        }).fail(function(data) {
            $validation.html('');
            $validation.prev().removeClass('is-invalid');
            Object.entries(data.responseJSON.errors).forEach(([key, value]) => {
                let $field = $('#' + key + '-validation');
                $field.prev().toggleClass('is-invalid');
                $field.html(value[0]);
            });
        });
    });
}
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

</body>

</html>
