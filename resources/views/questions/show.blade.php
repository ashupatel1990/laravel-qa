@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                    <h3>{{ $question->title }}</h3>
                        <div class="ml-auto" style="width:13%">
                            <a href="{{ route('questions.index') }}" class="btn btn-outline-secondary">All Questions</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    {!! $question->body !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection