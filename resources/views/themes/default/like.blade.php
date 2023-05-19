<div class="like-container">
    @can('like', $model)
    <form action="{{ route('like') }}" method="POST" class="like-form">
        @csrf
        <input type="hidden" name="likeable_type" value="{!! get_class($model) !!}"/>
        <input type="hidden" name="id" value="{{ $model->id }}"/>
        <button class="btn btn-lg like-button" data-action="like">
            <i class="fa-regular fa-thumbs-up text-primary" aria-hidden="true"></i>
        </button>
    </form>
    @endcan

    @can('unlike', $model)
    <form action="{{ route('unlike') }}" method="POST" class="like-form">
        @csrf
        @method('DELETE')
        <input type="hidden" name="likeable_type" value="{!! get_class($model) !!}"/>
        <input type="hidden" name="id" value="{{ $model->id }}"/>
        <button class="btn btn-lg like-button" data-action="unlike">
            <i class="fa-regular fa-thumbs-down text-primary" aria-hidden="true"></i>
        </button>
    </form>
    @endcan
</div>

<span class="likes-count">
    {{ trans_choice('{0} no likes|{1} :count like|[2,*] :count likes', count($model->likes), ['count' => count($model->likes)]) }}
</span>


@push('scripts')
<script>
    $(document).ready(function () {
    $('.like-container').on('click', '.like-button', function (event) {
    event.preventDefault();
            var $form = $(this).closest('.like-form');
            var action = $(this).data('action');
            $.ajax({
            type: $form.attr('method'),
                    url: $form.attr('action'),
                    data: $form.serialize(),
                    success: function (response) {
                    var likesCount = response.likes;
                            var likesText = likesCount === 0 ? 'No likes' : likesCount + ' Likes';
                            $('.likes-count').text(likesText);
                            if (action === 'like') {
                    $form.replaceWith('<form action="{{ route('unlike') }}" method="POST" class="like-form">' +
                            '@csrf' +
                            '@method('DELETE')' +
                            '<input type="hidden" name="likeable_type" value="' + '{!! addslashes(get_class($model)) !!}' + '"/>' +
                            '<input type="hidden" name="id" value="{{ $model->id }}"/>' +
                            '<button class="btn btn-lg like-button" data-action="unlike">' +
                            '<i class="fa-regular fa-thumbs-down text-primary" aria-hidden="true"></i>' +
                            '</button>' +
                            '</form>');
                    } else if (action === 'unlike') {
                    $form.replaceWith('<form action="{{ route('like') }}" method="POST" class="like-form">' +
                            '@csrf' +
                            '<input type="hidden" name="likeable_type" value="' + '{!! addslashes(get_class($model)) !!}' + '"/>' +
                            '<input type="hidden" name="id" value="{{ $model->id }}"/>' +
                            '<button class="btn btn-lg like-button" data-action="like">' +
                            '<i class="fa-regular fa-thumbs-up text-primary" aria-hidden="true"></i>' +
                            '</button>' +
                            '</form>');
                    }
                    }
            });
    });
            });
</script>
@endpush
