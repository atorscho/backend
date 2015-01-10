<div id="secondary">
	<ul>
		@if($extensions)
			<li class="drop right">
				<a href="#"><i class="fa fa-fw fa-cubes"></i><i class="fa fa-angle-down"></i></a>

				<div class="drop-box">
					<div class="title">@lang('backend::labels.extensions')</div>

					<ul>
						@foreach($extensions as $extension)
							<li>
								<a href="{{ $extension->route ? route($extension->route) : url($extension->uri) }}">
									@if($extension->icon)
										<i class="fa fa-fw fa-{{ $extension->icon }}"></i>
									@endif

									{{ $extension->name }}
								</a>
							</li>
						@endforeach
					</ul>
				</div>
			</li>
		@endif
		<li class="drop right">
			<a href="#"><i class="fa fa-fw fa-user"></i><i class="fa fa-angle-down"></i></a>

			<div class="drop-box">
				<div class="avatar-holder">
					<div class="welcome">
						<?php // todo - link to user's profile ?>

						{{{ Auth::user()->username }}}
					</div>
					<div class="avatar">
						<?php // todo - link to user's profile ?>
						<img src="{{ asset('packages/atorscho/backend/assets/img/misc/noavatar.png') }}" alt="@lang('backend::labels.userAvatar')" />
					</div>
				</div>
			</div>
		</li>
		<li {{ Route::currentRouteName() == 'admin.settings.index' ? 'class="active"' : '' }}>
			<a href="{{ route('admin.settings.index') }}">
				<i class="fa fa-fw fa-cog"></i>
			</a>
		</li>
		<li><a href="{{ getSetting('siteFront') }}"><i class="fa fa-fw fa-home"></i></a></li>
		<li><a href="{{ route('admin.logout') }}"><i class="fa fa-fw fa-sign-out"></i></a></li>
	</ul>
</div>
