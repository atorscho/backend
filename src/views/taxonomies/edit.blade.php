@section('content')
	<div class="row">
		{{ Form::model($taxonomy, ['route' => ['admin.taxonomies.update', $taxonomyType->id, $taxonomy->id], 'method' => 'PUT']) }}
			@include('backend::taxonomies._form')
		{{ Form::close() }}
	</div>
@stop
