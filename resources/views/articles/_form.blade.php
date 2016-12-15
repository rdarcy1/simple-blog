<form
        {{-- Set form method to POST if the desired method must be spoofed --}}
        method="{{ methodMustBeSpoofed($formMethod) ? 'POST' : $formMethod }}"
        action="{{ $formAction }}"
>
    {{ csrf_field() }}

    {{-- Spoof method here if necessary --}}
    @if (methodMustBeSpoofed($formMethod))
        {{ method_field($formMethod) }}
    @endif

    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ $article->title or null }}">
    </div>

    <div class="form-group">
        <label for="published_on">Publish Date</label>

        <input
                type="date" name="published_on" id="title" class="form-control"
                value="{{ $article->published_on or date('Y-m-d') }}"
        >
    </div>

    <div class="form-group">
        <label for="body">Article Body</label>
        <textarea name="body" id="body" class="form-control">{{ $article->body or null }}</textarea>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-default">{{ $submitButtonText or 'Submit' }}</button>
        <a href="{{ $cancelAction or url()->previous() }}" class="btn btn-default">Cancel</a>
    </div>

</form>