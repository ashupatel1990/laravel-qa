@csrf
<div class="form-group">
    <label for="question-title">{{ __('Title') }}:*</label>
    <input type="text" name="title" id="question-title" 
        class="form-control @error('title') is-invalid @enderror"
        value="{{ old('title', $question->title) }}" autocomplete="off"/>
    {{-- @if ($errors->has('title')) --}}
    {{-- @endif --}}
    @error('title')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="form-group">
    <label>Question Body: *</label>
    <textarea name="body" id="question-body" 
        class="form-control @error('body') is-invalid @enderror" 
        rows="10"> {{ old('body', $question->body) }}</textarea>
    @if ($errors->has('body'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('body') }}</strong>
        </span>
    @endif
</div>

<div class="form-group"> 
    <input type="submit" class="btn btn-outline-primary btn-lg" value="{{ $buttonText}} " />
</div>