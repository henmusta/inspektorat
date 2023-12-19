{{-- Extends layout --}}
@extends('admin.layout.default')

{{-- Content --}}
@section('content')

<div class="container-fluid">
	<div class="row page-titles mx-0">
		<div class="col-sm-6 p-0">
			<div class="welcome-text">
				<h4>{{ __('Blog Categories') }}</h4>
				<span>{{ __('All blog categories list') }}</span>
			</div>
		</div>
		<div class="col-sm-6 p-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ route('blog_category.admin.index') }}">{{ __('Blog categories') }}</a></li>
				<li class="breadcrumb-item active"><a href="javascript:void(0)">{{ __('All blog categories') }}</a></li>
			</ol>
		</div>
	</div>

	<div class="row">
        <!-- Column starts -->
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex">
                    <h4 class="card-title">{{ __('Search Blog Categories') }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('blog_category.admin.index') }}" method="get">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6 m-sm-0 form-group">
                                <input type="search" name="title" class="form-control" placeholder="{{ __('title') }}" value="{{ old('title', request()->input('title')) }}">
                            </div>
                            <div class="col-sm-6 text-sm-end">
                                <input type="submit" name="search" value="{{ __('Search') }}" class="btn btn-primary me-2"> <a href="{{ route('blog_category.admin.index') }}" class="btn btn-danger">{{ __('Reset') }}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

	<div class="row">
		<!-- Column starts -->
		<div class="col-xl-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">{{ __('Blog Categories') }}</h4>
					@can('Controllers > BlogCategoriesController > admin_create')
						<a href="{{ route('blog_category.admin.create') }}" class="btn btn-primary">{{ __('Add Blog Category') }}</a>
					@endcan
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-responsive-lg mb-0 min-width-40" >
							<thead>
								<tr>
									<th> <strong> {{ __('S.N.') }} </strong> </th>
									<th> <strong> {!! DzHelper::dzSortable('title', __('Name')) !!} </strong> </th>
									<th> <strong> {!! DzHelper::dzSortable('slug', __('Slug')) !!} </strong> </th>
									<th> <strong> {!! DzHelper::dzSortable('blog_count', __('Blog Count')) !!} </strong> </th>
									<th> <strong> {!! DzHelper::dzSortable('created_at', __('Created')) !!} </strong> </th>
									@canany(['Controllers > BlogCategoriesController > admin_edit', 'Controllers > BlogCategoriesController > admin_destroy'])
									<th class="text-center"> <strong> {{ __('Actions') }} </strong> </th>
                                    @endcanany
								</tr>
							</thead>
							<tbody>
								@php
									$i = $blog_categories ? $blog_categories->firstItem() : 0;
								@endphp
								@forelse ($blog_categories as $blog_category)
									<tr>
										<td> {{ $i++ }} </td>
										<td> {{ $blog_category['title'] }} </td>
										<td> {{ $blog_category['slug'] }} </td>
										<td> <span class="badge bg-primary">{{ $blog_category->blog_count }}</span> </td>
										<td> {{ $blog_category['created_at'] }} </td>
										<td class="text-center">
											@can('Controllers > BlogCategoriesController > admin_edit')
												<a href="{{ route('blog_category.admin.edit', $blog_category['id']) }}" class="btn btn-primary shadow btn-xs sharp me-1" title="{{ __('Edit') }}"><i class="fas fa-pencil-alt"></i></a>
											@endcan
											@can('Controllers > BlogCategoriesController > admin_destroy')
												<a href="{{ route('blog_category.admin.destroy', $blog_category['id']) }}" class="btn btn-danger shadow btn-xs sharp" title="{{ __('Delete') }}"><i class="fa fa-trash"></i></a>
											@endcan
										</td>
									</tr>
								@empty
									<tr><td class="text-center" colspan="6"><p>{{ __('No blog categories') }}</p></td></tr>
								@endforelse

							</tbody>
						</table>
					</div>
				</div>
				<div class="card-footer">
					{{ $blog_categories ? $blog_categories->onEachSide(1)->appends(Request::input())->links() : '' }}
				</div>
			</div>
		</div>
	</div>

</div>


@endsection