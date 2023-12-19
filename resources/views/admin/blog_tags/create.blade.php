{{-- Extends layout --}}
@extends('admin.layout.default')

{{-- Content --}}
@section('content')

<div class="container-fluid">

	<div class="row page-titles mx-0 mb-3">
		<div class="col-sm-6 p-0">
			<div class="welcome-text">
				<h4>{{ __('Blog Tag') }}</h4>
				<span>{{ __('Add Blog Tag') }}</span>
			</div>
		</div>
		<div class="col-sm-6 p-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ route('blog_tag.admin.index') }}">{{ __('Blog Tag') }}</a></li>
				<li class="breadcrumb-item active"><a href="javascript:void(0)">{{ __('Add Blog Tag') }}</a></li>
			</ol>
		</div>
	</div>

	<form action="{{ route('blog_tag.admin.store') }}" method="post" enctype="multipart/form-data">
		@csrf
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">{{ __('Add Blog Tag') }}</h4>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="form-group col-md-6">
								<label for="BlogTitle">{{ __('Title') }}</label>
								<input type="text" name="data[BlogTag][title]" class="form-control" id="BlogTitle" placeholder="{{ __('Title') }}">
								@error('data.BlogTag.title')
									<p class="text-danger">
										{{ $message }}
									</p>
								@enderror
							</div>
							<div class="form-group col-md-6">
								<label for="BlogSlug">{{ __('Slug') }}</label>
								<input type="text" name="data[BlogTag][slug]" class="slug form-control" id="BlogSlug" placeholder="{{ __('Slug') }}" readonly="readonly" maxlength="255" required="required">
								@error('data.BlogTag.slug')
									<p class="text-danger">
										{{ $message }}
									</p>
								@enderror
							</div>
						</div>
					</div>
					<div class="card-footer">
						<button type="submit" class="btn btn-primary" title="{{ __('Click here to Save Blog Tag') }}">{{ __('Save') }}</button>
						<a href="{{ route('blog_tag.admin.index') }}" class="btn btn-danger">{{ __('Back') }}</a>
					</div>
				</div>
			</div>	
		</div>
	</form>
</div>
@endsection

