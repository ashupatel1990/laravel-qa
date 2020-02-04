<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h3> Your Answer </h3>
                </div>
                <hr/>
                <form action="{{ route('questions.answers.store', $question->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Answer Body: *</label>
                        <textarea rows="5" name="body" class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}">{{ old('body')}} </textarea>
                        @if ($errors->has('body'))
                            <div class="invalid-feedback">
                            <strong>{{ $errors->first('body') }}</strong>
                            </div>
                        @endif
                        <button type="submit" class="btn btn-lg btn-outline-primary"> Submit </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>