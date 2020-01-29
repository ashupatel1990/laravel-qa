@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h3>Edit Question</h3>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('questions.update', $question->id) }}" method="POST">
                        {{ method_field('PUT') }}
                        @include('layouts._form', ['buttonText' => 'Edit Question'])
  
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection