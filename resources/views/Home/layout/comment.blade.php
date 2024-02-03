@php
use Morilog\Jalali\Jalalian;
@endphp
<!-- Blog Comments -->

<!-- Comments Form -->
@if(auth()->check())
    <div class="well">
        <h4>ثبت نظر :</h4>
        @include('Home.layout.errors')
        <form role="form" action="/comment" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="parent_id" value="0">
            <input type="hidden" name="commentable_id" value="{{ $subject->id }}">
            <input type="hidden" name="commentable_type" value="{{ get_class($subject) }}">
            <div class="form-group">
                <textarea name="comment" class="form-control" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">ارسال</button>
        </form>
    </div>
@else
    <div class="alert alert-danger">شما برای ارسال نظر باید وارد سایت شوید</div>
@endif

<hr>

<!-- Posted Comments -->

@foreach($comments as $comment)
    <div class="media">
        <a class="pull-right" href="#">
            <img class="media-object" src="http://placehold.it/64x64" alt="">
        </a>
        <div class="media-body">
            <h4 class="media-heading">{{ $comment->user->name }}
                <small>{{ jdate($comment->created_at)->ago() }}</small>
                <button class="pull-left btn btn-xs btn-success" data-toggle="modal" data-target="#sendCommentModal" data-parent="{{ $comment->id }}">پاسخ</button>
            </h4>
            {!! $comment->comment !!}
            <!-- Nested Comment -->
            @if(count($comment->comments))
                @foreach($comment->comments as $childComment)
                    <div class="media">
                        <a class="pull-right" href="#">
                            <img class="media-object" src="http://placehold.it/64x64" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">{{ $childComment->user->name }}
                                <small>{{ jdate($childComment->created_at)->ago() }}</small>
                            </h4>
                            {!! $childComment->comment !!}
                        </div>
                    </div>
                @endforeach
            @endif
            <!-- End Nested Comment -->
        </div>
    </div>
@endforeach
<!-- Comment -->

<div class="modal fade" id="sendCommentModal" tabindex="-1" role="dialog" aria-labelledby="sendCommentModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">ارسال پاسخ</h4>
            </div>
            <div class="modal-body">
                <form action="/comment" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="parent_id" value="0">
                    <input type="hidden" name="commentable_id" value="{{ $subject->id }}">
                    <input type="hidden" name="commentable_type" value="{{ get_class($subject) }}">

                    <div class="form-group">
                        <label for="message-text" class="control-label">متن پاسخ:</label>
                        <textarea class="form-control" id="message-text" name="comment"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">ارسال</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">انصراف</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<!-- Bootstrap JavaScript -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<!-- Your script comes after jQuery and Bootstrap -->
<script>
    $(document).ready(function() {
        console.log('Document is ready.');

        $('#sendCommentModal').on('show.bs.modal', function(event) {
            console.log('Modal is about to be shown.');

            let button = $(event.relatedTarget);
            let parentId = button.data('parent');
            let modal = $(this);
            modal.find("[name='parent_id']").val(parentId); // Set parent_id
        });
    });
</script>




