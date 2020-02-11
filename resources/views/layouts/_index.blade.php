<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h3> {{ $questionCount . ' ' . Str::plural('answer', $questionCount) }} </h3>
                </div>
                <hr/>
                @include('layouts._messages');
                @foreach ($answers as $answer)
                    <div class="media">
                        <div class="d-fex flex-column vote-controls">
                            <a title="This question is useful" class="vote-up">
                                <i class="fas fa-caret-up fa-3x"></i>
                            </a>
                            <span class="votes-count">{{ $answer->votes_count }}</span>
                            <a title="This question is not useful" class="vote-down off">
                                <i class="fas fa-caret-down fa-3x"></i>
                            </a>
                            <a title="Mark this answer as best answer" class="vote-accepted mt-2">
                                <i class="fas fa-check fa-2x"></i>
                            </a>
                        </div>
                        <div class="media-body">
                            {!! $answer->body !!}
                            <div class="float-right">
                                <span class="text-muted">Answered {{ $answer->created_date }}</span>
                                <div class="media">
                                    <a href=" {{ $answer->user->url }}" class="pr-2">
                                        <img src="{{ $answer->user->avatar }}" />
                                    </a>
                                    <div class="media-body mt-1">
                                        <a href=" {{ $answer->user->url }}">
                                            {{ $answer->user->name }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr/>
                @endforeach
            </div>
        </div>
    </div>
</div>