@section('content')
	<div class="row">
		{{ Form::open(['route' => ['admin.taxonomies.store', $taxonomyType->id]]) }}
			@include('backend::taxonomies._form')
		{{ Form::close() }}
	</div>
@stop
