
@if($message)
	<div class="alert alert-{{ $type }}">
		<button type="button" class="close" data-dismiss="alert">
			<span aria-hidden="true">&times;</span><span class="sr-only">@lang('backend::labels.close')</span>
		</button>
		<i class="fa fa-fw fa-2x pull-left fa-{{ $icon }}"></i>

		{{{ $message }}}
	</div>
@endif
