<?php // todo - translate ?>
<div id="secondary">
	<ul>
		<li class="drop right">
			<a href="#"><i class="fa fa-fw fa-cubes"></i><i class="fa fa-angle-down"></i></a>

			<div class="drop-box">
				<div class="title">Extensions</div>

				<ul>
					@foreach($extensions as $extension)
						<li>
							<a href="{{ $extension->route ? route($extension->route) : to($extension->uri) }}">
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
		<li class="drop right">
			<a href="#"><i class="fa fa-fw fa-bell"></i><i class="fa fa-angle-down"></i></a>

			<div class="drop-box">
				<div class="title">Recent Notifications</div>

				<ul>
					<li><a href="#">Item 1</a></li>
					<li><a href="#">Item 2</a></li>
					<li><a href="#">Item 3</a></li>
					<li><a href="#">Item 4</a></li>
				</ul>
			</div>
		</li>
		<li class="drop right">
			<a href="#"><i class="fa fa-fw fa-envelope"></i><i class="fa fa-angle-down"></i></a>

			<div class="drop-box">
				<div class="title">Inbox</div>

				<ul>
					<li><a href="#">Message 1</a></li>
					<li><a href="#">Message 2</a></li>
					<li><a href="#">Message 3</a></li>
					<li><a href="#">Message 4</a></li>
				</ul>
			</div>
		</li>
		<li class="drop right">
			<a href="#"><i class="fa fa-fw fa-user"></i><i class="fa fa-angle-down"></i></a>

			<div class="drop-box">
				<div class="avatar-holder">
					<div class="welcome">
						<?php // todo - link to user's profile ?>

						{{{ Auth::user()->username }}}
						</p>
					</div>
					<div class="avatar">
						<?php // todo - link to user's profile ?>
						<img src="{{ asset('packages/atorscho/backend/assets/img/misc/noavatar.png') }}" alt="User Avatar" />
					</div>
				</div>
			</div>
		</li>
		<li><a href="{{ route('admin.settings') }}"><i class="fa fa-fw fa-cog"></i></a></li>
		<li><a href="{{ getSetting('siteFront') }}"><i class="fa fa-fw fa-home"></i></a></li>
		<li><a href="{{ route('admin.logout') }}"><i class="fa fa-fw fa-sign-out"></i></a></li>
	</ul>
</div>
