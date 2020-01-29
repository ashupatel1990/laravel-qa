@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h3>Ask Question</h3>
                        <div class="ml-auto">
                            <a href="{{ route('questions.index') }}" class="btn btn-outline-secondary">Back to all Question</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('questions.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="question-title">{{ __('Title') }}:*</label>
                            <input type="text" name="title" id="question-title" 
                                class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title') }}" autocomplete="off"/>
                            {{-- @if ($errors->has('title')) --}}
                            {{-- @endif --}}
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Question Body:*</label>
                            <textarea name="body" id="question-body" 
                                class="form-control @error('body') is-invalid @enderror" 
                                rows="10"
                                value="{{ old('body') }}" autocomplete="off"></textarea>
                            @if ($errors->has('body'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('body') }}</strong>
                                </span>
                            @endif
                        </div>
                        
                        <div class="form-group"> 
                            <input type="submit" class="btn btn-outline-primary btn-lg" value="Submit question" />
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection