@section('content')
	<div class="row">
		{{ Form::open(['route' => 'admin.taxonomy-types.store']) }}
			@include('backend::taxonomies.types._form')
		{{ Form::close() }}
	</div>
@stop
