<?php // todo - translate ?>
<?php // todo - complete view ?>

@section('content')
	@foreach($user->fields as $field)
		<div>{{ $field->name }}: {{ $field->pivot->value }}</div>
	@endforeach
@stop
