<?php // todo - translate ?>

@section('content')
	<div class="row">
		{{ Form::model($content, ['route' => ['admin.contents.update', $contentType->id, $content->id], 'method' => 'PUT']) }}
			@include('backend::contents._form')
		{{ Form::close() }}
	</div>
@stop
