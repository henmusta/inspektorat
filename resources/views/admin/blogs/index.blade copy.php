{{-- Extends layout --}}
@extends('admin.layout.default')

{{-- Content --}}
@section('content')

<div class="container-fluid">
	<div class="row page-titles mx-0 mb-3">
		<div class="col-sm-6 p-0">
			<div class="welcome-text">
				<h4>Postingan</h4>
				<span>List Postingan</span>
			</div>
		</div>
		<div class="col-sm-6 p-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ route('blog.admin.index') }}">Postingan</a></li>
				<li class="breadcrumb-item active"><a href="javascript:void(0)">List Posting</a></li>
			</ol>
		</div>
	</div>

	<div class="row">
		<!-- Column starts -->
		<div class="col-xl-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Postingan</h4>
					<div>
						@can('Controllers > BlogsController > admin_create')
							<a href="{{ route('blog.admin.create') }}" class="btn btn-primary">Tambah Postingan</a>
						@endcan
						@can('Controllers > BlogCategoriesController > admin_index')
							<a href="{{ route('blog_category.admin.index') }}" class="btn btn-primary">List Kategori</a>
						@endcan
						<a href="{{ route('blog.admin.trash_list') }}" class="btn btn-primary">Trash Posting</a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-responsive-lg mb-0">
							<thead class="">
								<tr>
									<th> <strong> {{ __('S.N.') }} </strong> </th>
									<th> <strong> {!! DzHelper::dzSortable('title', __('Title')) !!} </strong> </th>
									<th> <strong> {!! DzHelper::dzSortable('name.users', __('Author')) !!} </strong> </th>
									<th> <strong> {!! DzHelper::dzSortable('status', __('Status')) !!} </strong> </th>
									<th> <strong> {!! DzHelper::dzSortable('visibility', __('Visibility')) !!} </strong> </th>
									<th> <strong> {!! DzHelper::dzSortable('created_at', __('Created')) !!} </strong> </th>
									@canany(['Controllers > BlogsController > admin_edit', 'Controllers > BlogsController > admin_destroy'])
										<th class="text-center"> <strong> {{ __('Actions') }} </strong> </th>
                                    @endcanany
								</tr>
							</thead>
							<tbody>
								@php
									$i = $blogs->firstItem();
								@endphp
								@forelse ($blogs as $page)
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
											@can('Controllers > BlogsController > admin_edit')
												<a href="{{ route('blog.admin.edit', $page->id) }}" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
											@endcan
											@can('Controllers > BlogsController > admin_destroy')
												<a href="{{ route('blog.admin.admin_trash_status', $page->id) }}" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
											@endcan
										</td>
									</tr>
								@empty
									<tr><td class="text-center" colspan="7"><p>{{ __('No blogs found.') }}</p></td></tr>
								@endforelse

							</tbody>
						</table>
					</div>
				</div>
				<div class="card-footer">
                    {{ $blogs->onEachSide(2)->appends(Request::input())->links() }}
				</div>
			</div>
		</div>
	</div>

</div>


@endsection
