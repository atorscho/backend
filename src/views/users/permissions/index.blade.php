@section('content')
	<div class="blok">
		<div class="row">
			<div class="col-md-3">
				<aside class="sidebar">
                	@include('backend::partials.users._sidebar')
                </aside>
			</div>
			<div class="col-md-9">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th class="width-50">#</th>
                        <th>@lang('backend::labels.name')</th>
                        <th>@lang('backend::labels.handle')</th>
                        <th class="text-center width-80">@lang('backend::labels.id')</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>@lang('backend::labels.name')</th>
                        <th>@lang('backend::labels.handle')</th>
                        <th class="text-center">@lang('backend::labels.id')</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($permissions as $permission)
                        <tr>
                            <td>{{ index() }}</td>
                            <td>{{ $permission->name }}</td>
                            <td class="handle">{{{ $permission->handle }}}</td>
                            <td class="text-center">{{{ $permission->id }}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
		</div>
	</div>
@stop
