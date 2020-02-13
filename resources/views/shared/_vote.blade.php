<div class="d-fex flex-column vote-controls">
	<a title="This question is useful" class="vote-up">
		<i class="fas fa-caret-up fa-3x"></i>
	</a>
	<span class="votes-count">{{ $model->votes }}</span>
	<a title="This question is not useful" class="vote-down off">
		<i class="fas fa-caret-down fa-3x"></i>
	</a>
	{{-- <a title="Click to mark as favorite question (Click again to undo)" 
		class="favorite mt-2 {{ Auth::guest() ? 'off' : ($model->is_favourited ? 'favorited': '')}}"
		onclick="event.preventDefault(); document.getElementById('favourite-question-{{ $model->id }}').submit();">
		<i class="fas fa-star fa-2x"></i>
		<span class="favorites-count">{{ $model->favourites_count }}</span>
	</a> --}}
	<favourite :model="{{ $model }}"></favourite>
	{{-- <form id="favourite-question-{{ $model->id }}" 
		method="post"
		action="/questions/{{ $model->id }}/favourite" style="display:none;">
		@csrf
		@if ($model->is_favourited)
		    @method('DELETE')
		@endif
	</form> --}}
</div>
