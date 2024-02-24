@extends('layouts.app')

@push('styles')
@endpush

@section('content')
    <div class="container mt-5">
        <div class="row">
            <form action="{{ URL::to('store') }}" id="addForm" method="POST">
                @csrf

                <div class="col-md-6">
                    <input type="text" class="form-control" name="name" placeholder="Name" autocomplete="off">
                    <span class="text-danger" id="error-name"></span>
                </div>

                <div class="col-md-6">
                    <input type="text" class="form-control" name="comment" placeholder="Comment" autocomplete="off">
                    <span class="text-danger" id="error-comment"></span>
                </div>

                <div class="col-md-12 mt-2">
                    <button class="btn btn-primary" type="submit">Add</button>
                </div>
            </form>
        </div>


        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="text-center">Name</th>
                    <th class="text-center">Comment</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody id="comments-container">

            </tbody>
        </table>
        @include('comments.modal')
    </div>
@endsection

@push('scripts')
    <script>
        // loading
        $(document).ready(function() {
            showContent();
            let nextPageUrl = '{{ $comments->nextPageUrl() }}';
            $(window).scroll(function() {
                if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
                    if (nextPageUrl) {
                        loadMoreComments();
                    }
                }
            });
            function loadMoreComments() {
                $.ajax({
                    url: nextPageUrl,
                    type: 'get',
                    beforeSend: function() {
                        nextPageUrl = '';
                    },
                    success: function(data) {
                        nextPageUrl = data.nextPageUrl;
                        $('#comments-container').append(data.view);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error loading more comments:", error);
                    }
                });
            }
            // add comment
            $('#addForm').on('submit', function(e) {
                e.preventDefault();
                var form = $(this);
                var formData = new FormData(form[0]);
                var url = form.attr('action');
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success: function(response) {
                        $('#addForm')[0].reset();
                        loadMoreComments();
                        showContent();


                    },
                    error: function(xhr, status, error) {
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            $('#error-' + key).text(value);
                        });
                    }
                });
            });
            // update comment
            $(document).on('click', '.edit', function(event) {
                event.preventDefault();
                var id = $(this).data('id');
                var name = $(this).data('name');
                var comment = $(this).data('comment');
                $('#editmodal').modal('show');
                $('#name').val(name);
                $('#comment').val(comment);
                $('#memid').val(id);
            });
            $('#editForm').on('submit', function(e) {
                e.preventDefault();
                var form = $(this).serialize();
                var url = $(this).attr('action');
                $.post(url, form, function(data) {
                    $('#editmodal').modal('hide');
                    loadMoreComments();
                    showContent();

                });
            });
            // update delete
            $(document).on('click', '.delete', function(event) {
                event.preventDefault();
                var id = $(this).data('id');
                $('#deletemodal').modal('show');
                $('#d_id').val(id);
            });
            $('#deleteForm').on('submit', function(e) {
                e.preventDefault();
                var form = $(this).serialize();
                var url = $(this).attr('action');
                $.post(url, form, function(data) {
                    $('#deletemodal').modal('hide');
                    loadMoreComments();
                    showContent();

                });
            });
            function showContent() {
                $.get("{{ URL::to('show') }}", function(data) {
                    $('#comments-container').empty().html(data);
                });
            }
        });
    </script>
@endpush
