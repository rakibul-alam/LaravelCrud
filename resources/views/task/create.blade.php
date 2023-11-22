<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Laravel Task Project</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left mb-2">
                    <h2>Laravel Task Project</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('tasks.index') }}"> Back</a>
                </div>
            </div>
        </div>
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
        @endif
        <form action="{{ route('tasks.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Title:</strong>
                        <input type="text" name="title" id="title" class="form-control" placeholder="title">
                        @error('title')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Name:</strong>
                        <input type="text" name="name" id="name" class="form-control" placeholder="name">
                        @error('email')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Date:</strong>
                        <input type="date" name="release_date" id="release_date" class="form-control" placeholder="date">
                        @error('release_date')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Description</strong>
                        <input type="text" name="description" class="form-control" placeholder="description">
                        @error('description')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-success ml-3">Submit</button>
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
