{{-- Extends layout --}}
@extends('admin.layout.default')

{{-- Content --}}
@section('content')

<div class="container-fluid">
	<div class="row page-titles mx-0 mb-3">
		<div class="col-sm-6 p-0">
			<div class="welcome-text">
				<h4>Pages</h4>
				<span>All Pages</span>
			</div>
		</div>
		<div class="col-sm-6 p-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ route('page.admin.index') }}">Pages</a></li>
				<li class="breadcrumb-item active"><a href="javascript:void(0)">List Pages</a></li>
			</ol>
		</div>
	</div>

	@php
        $collapsed = 'collapsed';
        $show = '';
    @endphp



	<div class="row">
		<!-- Column starts -->
		<div class="col-xl-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">{{ __('Pages') }}</h4>
					<div>
						@can('Controllers > PagesController > admin_create')
							<a href="{{ route('page.admin.create') }}" class="btn btn-primary">Tambah Pages</a>
						@endcan
						<a href="{{ route('page.admin.trash_list') }}" class="btn btn-primary">{{ __('Trashed Pages') }}</a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-responsive-lg mb-0">
							<thead>
								<tr>
									<th> <strong> {{ __('S.N.') }} </strong> </th>
									<th> <strong> {!! DzHelper::dzSortable('title', __('Title')) !!} </strong> </th>
									<th> <strong> {!! DzHelper::dzSortable('name.users', __('Author')) !!} </strong> </th>
									<th> <strong> {!! DzHelper::dzSortable('status', __('Status')) !!} </strong> </th>
									<th> <strong> {!! DzHelper::dzSortable('visibility', __('Visibility')) !!} </strong> </th>
									<th> <strong> {!! DzHelper::dzSortable('created_at', __('Created')) !!} </strong> </th>
									@canany(['Controllers > PagesController > admin_edit', 'Controllers > PagesController > admin_destroy'])
										<th class="text-center"> <strong> {{ __('Actions') }} </strong> </th>
                                    @endcanany
								</tr>
							</thead>
							<tbody>
								@php
									$i = $pages->firstItem();
								@endphp
								@forelse ($pages as $page)
									<tr>
										<td> {{ $i++ }} </td>
										<td> {{ Str::limit($page->title, 30, ' ...') }} </td>
										<td> {{ $page->user_name }} </td>
										<td> {{ $status[$page->status] }} </td>
										<td>
											@if ($page->visibility == 'Pr')
												<span class="badge badge-danger">{{ __('Private') }}</span>
											@elseif($page->visibility == 'PP')
												<span class="badge badge-warning">{{ __('Password Protected') }}</span>
											@else
												<span class="badge badge-success">{{ __('Public') }}</span>
											@endif
										</td>
										<td> {{ $page->created_at }} </td>
										<td class="text-center">
											@can('Controllers > PagesController > admin_edit')
												<a href="{{ route('page.admin.edit', $page->id) }}" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
											@endcan
											@can('Controllers > PagesController > admin_destroy')
												<a href="{{ route('page.admin.admin_trash_status', $page->id) }}" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
											@endcan
										</td>
									</tr>
								@empty
									<tr><td class="text-center" colspan="7"><p>{{ __('No pages found.') }}</p></td></tr>
								@endforelse

							</tbody>
						</table>
					</div>
				</div>
				<div class="card-footer">
					{{ $pages->onEachSide(2)->appends(Request::input())->links() }}
				</div>
			</div>
		</div>
	</div>

</div>


@endsection
