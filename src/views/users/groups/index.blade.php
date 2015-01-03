@section('content')
	<div class="blok">
		<div class="row">
			<div class="col-md-3">
				<aside class="sidebar">
                	@include('backend::partials.users._sidebar')

                    @if(Auth::user()->can('createGroups'))
                        <div class="text-center">
                            <a class="btn btn-primary" href="{{{ route('admin.users.groups.create') }}}"><i class="fa fa-fw fa-plus-circle"></i> @lang('backend::labels.groupsNew')</a>
                        </div>
                    @endif
                </aside>
			</div>
			<div class="col-md-9">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th class="width-50">#</th>
                        <th>@lang('backend::labels.name')</th>
                        <th>@lang('backend::labels.handle')</th>
                        <th class="text-center width-100">@lang('backend::labels.members')</th>
                        <th class="text-center width-80">@lang('backend::labels.id')</th>
                        <th class="text-center width-100">@lang('backend::labels.actions')</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>@lang('backend::labels.name')</th>
                        <th>@lang('backend::labels.handle')</th>
                        <th class="text-center">@lang('backend::labels.members')</th>
                        <th class="text-center">@lang('backend::labels.id')</th>
                        <th class="text-center">@lang('backend::labels.actions')</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($groups as $group)
                        <tr>
                            <td>{{ index() }}</td>
                            <td data-href="{{ route('admin.users.groups.show', $group->id) }}">{{ $group->name_formatted }}</td>
                            <td class="handle">{{{ $group->handle }}}</td>
                            <td class="text-center" data-href="{{ route('admin.users.groups.show', $group->id) }}">
                                <span class="text-primary">{{{ $group->users()->count() }}}</span>
                            </td>
                            <td class="text-center">{{{ $group->id }}}</td>
                            <td class="text-center">
                                {{ Form::open(['route' => ['admin.users.groups.destroy', $group->id], 'method' => 'DELETE']) }}
	                                <div class="btn-group">
	                                    <a class="btn btn-sm btn-primary" href="{{ route('admin.users.groups.edit', $group->id) }}">
	                                        <i class="fa fa-fw fa-edit"></i>
	                                    </a>
	                                    <button class="btn btn-sm btn-primary" {{ in_array($group->id, $protectedGroups) ? 'disabled="disabled"' : '' }}>
	                                        <i class="fa fa-fw fa-times"></i>
	                                    </button>
	                                </div>
                                {{ Form::close() }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
		</div>
	</div>
@stop
