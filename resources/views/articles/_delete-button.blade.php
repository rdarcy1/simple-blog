<form method="POST" action="{{ route('articles.destroy', $articleId) }}">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <button type="submit" class="btn pull-right btn-danger">Delete Article</button>

    @if (isset($confirmed))
        <input type="hidden" name="confirmed" value="true">
    @endif
</form>