@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <div class="d-flex align-items-center">
                            <h3>{{ $question->title }}</h3>
                            <div class="ml-auto" style="width:13%">
                                <a href="{{ route('questions.index') }}" class="btn btn-outline-secondary">All Questions</a>
                            </div>
                        </div>
                    </div>
                
                    <hr/>
                    
                    <div class="media">
                        @include('shared._vote', [
                            'model' => $question
                        ])
                        
                        <div class="media-body">
                            {!! $question->body !!}
                            <user-info :model="{{ $question }}" label="Answered"></user-info>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include ('answers._index', [
        'questionCount' => $question->answers_count,
        'answers' => $question->answers
    ])

    @include ('answers._create')
</div>
@endsection