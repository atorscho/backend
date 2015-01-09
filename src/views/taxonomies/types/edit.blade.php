@section('content')
	<div class="row">
		{{ Form::model($taxonomyType, ['route' => ['admin.taxonomy-types.update', $taxonomyType->id], 'method' => 'PUT']) }}
			@include('backend::taxonomies.types._form')
		{{ Form::close() }}
	</div>
@stop
