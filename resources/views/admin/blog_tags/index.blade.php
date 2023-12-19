{{-- Extends layout --}}
@extends('admin.layout.default')

{{-- Content --}}
@section('content')

<div class="container-fluid">
	<div class="row page-titles mx-0">
		<div class="col-sm-6 p-0">
			<div class="welcome-text">
				<h4>{{ __('Blog Tags') }}</h4>
				<span>{{ __('All blog tags list') }}</span>
			</div>
		</div>
		<div class="col-sm-6 p-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ route('blog_tag.admin.index') }}">{{ __('Blog tags') }}</a></li>
				<li class="breadcrumb-item active"><a href="javascript:void(0)">{{ __('All blog tags') }}</a></li>
			</ol>
		</div>
	</div>

	<div class="row">
        <!-- Column starts -->
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex">
                    <h4 class="card-title">{{ __('Search Blog Tags') }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('blog_tag.admin.index') }}" method="get">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6 m-sm-0 form-group">
                                <input type="search" name="title" class="form-control" placeholder="{{ __('title') }}" value="{{ old('title', request()->input('title')) }}">
                            </div>
                            <div class="col-sm-6 text-sm-end">
                                <input type="submit" name="search" value="{{ __('Search') }}" class="btn btn-primary me-2"> 
                                <a href="{{ route('blog_tag.admin.index') }}" class="btn btn-danger">{{ __('Reset') }}</a>
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
					<h4 class="card-title">{{ __('Blog Tags') }}</h4>
					@can('Controllers > BlogTagsController > admin_create')
						<a href="{{ route('blog_tag.admin.create') }}" class="btn btn-primary">{{ __('Add Blog Tag') }}</a>
					@endcan
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-responsive-lg mb-0">
							<thead>
								<tr>
									<th> <strong> {{ __('S.N.') }} </strong> </th>
									<th> <strong> {!! DzHelper::dzSortable('title', __('Name')) !!} </strong> </th>
									<th> <strong> {!! DzHelper::dzSortable('slug', __('Slug')) !!} </strong> </th>
									<th> <strong> {!! DzHelper::dzSortable('blog_count', __('Blog Count')) !!} </strong> </th>
									<th> <strong> {!! DzHelper::dzSortable('created_at', __('Created')) !!} </strong> </th>
									@canany(['Controllers > BlogTagsController > admin_edit', 'Controllers > BlogTagsController > admin_destroy'])
										<th class="text-center"> <strong> {{ __('Actions') }} </strong> </th>
                                    @endcanany
								</tr>
							</thead>
							<tbody>
								@php
									$i = $blog_tags ? $blog_tags->firstItem() : 0;
								@endphp
								@forelse ($blog_tags as $blog_tag)
									<tr>
										<td> {{ $i++ }} </td>
										<td> {{ $blog_tag->title }} </td>
										<td> {{ $blog_tag->slug }} </td>
										<td> <span class="badge bg-primary">{{ $blog_tag->blog_count }}</span> </td>
										<td> {{ $blog_tag->created_at }} </td>
										<td class="text-center">
											@can('Controllers > BlogTagsController > admin_edit')
												<a href="{{ route('blog_tag.admin.edit', $blog_tag->id) }}" class="btn btn-primary shadow btn-xs sharp me-1" title="{{ __('Edit') }}"><i class="fas fa-pencil-alt"></i></a>
											@endcan
											@can('Controllers > BlogTagsController > admin_destroy')
												<a href="{{ route('blog_tag.admin.destroy', $blog_tag->id) }}" class="btn btn-danger shadow btn-xs sharp" title="{{ __('Delete') }}"><i class="fa fa-trash"></i></a>
											@endcan
										</td>
									</tr>
								@empty
									<tr><td class="text-center" colspan="6"><p>{{ __('No blog tags found') }}</p></td></tr>
								@endforelse

							</tbody>
						</table>
					</div>
				</div>
				<div class="card-footer">
					{{ $blog_tags ? $blog_tags->onEachSide(1)->appends(Request::input())->links() : '' }}
				</div>
			</div>
		</div>
	</div>

</div>


@endsection