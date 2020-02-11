<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h3> {{ $questionCount . ' ' . Str::plural('answer', $questionCount) }} </h3>
                </div>
                <hr/>
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
                            @can ('accept', $answer)
                                <a title="Mark this answer as best answer" 
                                    class="{{ $answer->status }} mt-2"
                                    onclick="event.preventDefault(); document.getElementById('accept-answer-{{ $answer->id }}').submit();">
                                    <i class="fas fa-check fa-2x"></i>
                                </a>
                                <form id="accept-answer-{{ $answer->id }}" 
                                    method="post"
                                    action="{{ route('answers.accept', $answer->id) }}" 
                                    style="display:none;">
                                    @csrf
                                </form>
                            @else 
                                @if ($answer->is_best)
                                <a title="Question owner accept this answer as best answer" class="{{ $answer->status }} mt-2">
                                    <i class="fas fa-check fa-2x"></i>
                                </a>
                                @endif
                            @endcan
                        </div>
                        <div class="media-body">
                            {!! strip_tags($answer->body) !!}
                            <div class="row">
                                <div class="col-4">
                                    @can ('update', $answer)
                                        <a href="{{ route('questions.answers.edit', [$question->id, $answer->id]) }}" class="btn btn-sm btn-outline-info">Edit</a>
                                    @endcan
                                    @can ('delete', $answer)
                                        <form class="form-delete" method="post" action="{{ route('questions.answers.destroy', [$question->id, $answer->id]) }}">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    @endcan
                                </div>
                            </div>

                            <user-info :model="{{ $answer }}" label="Answered"></user-info>
                            {{-- <div class="float-right">
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
                            </div> --}}
                        </div>
                    </div>
                    <hr/>
                @endforeach
            </div>
        </div>
    </div>
</div>