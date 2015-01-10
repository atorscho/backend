@section('content')
	<div class="row">
		<div class="col-md-9">
			<div class="com-boxes">
				<a class="box tip" href="{{ route('admin.users.index') }}" title="@lang('backend::labels.usersAndGroups')">
					<i class="fa fa-fw fa-group"></i>
				</a>
				<a class="box tip" href="{{ route('admin.content-types.show', $article->slug) }}" title="@lang('backend::labels.articles')">
					<i class="fa fa-fw fa-{{ $article->icon }}"></i>
				</a>
				<a class="box tip" href="{{ route('admin.content-types.show', $page->slug) }}" title="@lang('backend::labels.pages')">
					<i class="fa fa-fw fa-{{ $page->icon }}"></i>
				</a>
				<a class="box tip" href="{{ route('admin.taxonomy-types.show', $category->slug) }}" title="@lang('backend::labels.categories')">
					<i class="fa fa-fw fa-{{ $category->icon }}"></i>
				</a>
				<a class="box tip" href="{{ route('admin.users.fields.groups.index') }}" title="@lang('backend::labels.userFields')">
					<i class="fa fa-fw fa-sliders"></i>
				</a>
				<a class="box tip" href="{{{ route('admin.settings.index') }}}" title="@lang('backend::labels.settings')">
					<i class="fa fa-fw fa-cogs"></i>
				</a>
				<a class="box tip" href="{{ route('admin.users.index') }}" title="Users and Groups">
					<i class="fa fa-fw fa-group"></i>
				</a>
				<a class="box tip" href="{{ route('admin.users.fields.groups.index') }}" title="User Fields">
					<i class="fa fa-fw fa-sliders"></i>
				</a>
				<a class="box tip" href="#" title="Menu Manager">
					<i class="fa fa-fw fa-navicon"></i>
				</a>
				<a class="box tip" href="{{{ route('admin.settings.index') }}}" title="Settings">
					<i class="fa fa-fw fa-cogs"></i>
				</a>
			</div>
		</div>

		<div class="col-md-3">
			<aside class="blok">
				<header class="title">
					<h3>@lang('backend::labels.statistics')</h3>
				</header>
				<ul class="list">
					<li>@lang('backend::labels.users') <span class="badge pull-right">{{ $userCount }}</span></li>
					<li>@lang('backend::labels.articles') <span class="badge pull-right">{{ $article->contents->count() }}</span></li>
					<li>@lang('backend::labels.pages') <span class="badge pull-right">{{ $page->contents->count() }}</span></li>
				</ul>

				<header class="title">
					<h3>@lang('backend::labels.add')</h3>
				</header>
				<div class="navmenu">
					<ul>
						<li>{{ link_to_route('admin.users.create', trans('backend::labels.usersNew')) }}</li>
						<li>{{ link_to_route('admin.contents.create', trans('backend::labels.articlesNew'), 'articles') }}</li>
						<li>{{ link_to_route('admin.contents.create', trans('backend::labels.pagesNew'), 'pages') }}</li>
					</ul>
				</div>
			</aside>
		</div>
	</div>

	<br />

	<div class="row">
		<div class="col-md-6">
			<div class="blok">
				<header class="title">
					<h3>@lang('backend::labels.adminNotes')</h3>
				</header>

				<form action="">
					<div class="form-group">
						<textarea class="form-control" id="text" name="text" title="@lang('backend::labels.text')" style="height:96px"></textarea>
					</div>
					<div class="form-group clearfix">
						<button type="submit" class="btn btn-primary pull-right">@lang('backend::labels.adminNotesSave')</button>
					</div>
				</form>
			</div>
		</div>
		<div class="col-md-6">
			<ul class="nav nav-tabs nav-justified" role="tablist">
				<li class="active"><a href="#users" role="tab" data-toggle="tab">@lang('backend::labels.newestUsers')</a></li>
				<li><a href="#articles" role="tab" data-toggle="tab">@lang('backend::labels.newestArticles')</a></li>
				<li><a href="#pages" role="tab" data-toggle="tab">@lang('backend::labels.newestPages')</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="users">
					<ul class="list">
						@foreach($users as $user)
							<li>
								{{ link_to_route('admin.users.edit', $user->username, [$user->id]) }}
								<span class="label label-default pull-right">{{ getDateTimeFormat($user->created_at) }}</span>
							</li>
						@endforeach
					</ul>
				</div>
				<div class="tab-pane" id="articles">
					<ul class="list">
						@forelse($latestArticles as $content)
							<li>
								{{ link_to_route('admin.contents.edit', Str::limit($content->title, 30), ['articles', $content->id]) }}
								<small>(@lang('backend::labels.contentAuthor', ['link' => route('admin.users.edit', $content->created_by), 'username' => $content->creator->username]))</small>
								<span class="label label-default pull-right">{{ getDateTimeFormat($content->created_at) }}</span>
							</li>
						@empty
							<li>@lang('backend::messages.noArticles')</li>
						@endforelse
					</ul>
				</div>
				<div class="tab-pane" id="pages">
					<ul class="list">
						@forelse($latestPages as $content)
							<li>
								{{ link_to_route('admin.contents.edit', Str::limit($content->title, 30), ['articles', $content->id]) }}
								<small>(@lang('backend::labels.contentAuthor', ['link' => route('admin.users.edit', $content->created_by), 'username' => $content->creator->username]))</small>
								<span class="label label-default pull-right">{{ getDateTimeFormat($content->created_at) }}</span>
							</li>
						@empty
							<li>@lang('backend::messages.noPages')</li>
						@endforelse
					</ul>
				</div>
			</div>
		</div>
	</div>
@stop
