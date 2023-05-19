@can('like', $model)
<form action="{{ route('like') }}" method="POST">
    @csrf
    <input type="hidden" name="likeable_type" value="{{ get_class($model) }}"/>
    <input type="hidden" name="id" value="{{ $model->id }}"/>
    <button class="btn btn-lg"><i class="fa-regular fa-thumbs-up text-primary" aria-hidden="true"></i></button>
</form>
@endcan

@can('unlike', $model)
<form action="{{ route('unlike') }}" method="POST">
    @csrf
    @method('DELETE')
    <input type="hidden" name="likeable_type" value="{{ get_class($model) }}"/>
    <input type="hidden" name="id" value="{{ $model->id }}"/>
    <button class="btn btn-lg"><i class="fa-regular fa-thumbs-down text-primary" aria-hidden="true"></i></button>
</form>
@endcan
{{ trans_choice('{0} no likes|{1} :count like|[2,*] :count likes', count($model->likes), ['count' => count($model->likes)]) }}