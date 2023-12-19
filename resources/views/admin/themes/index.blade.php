{{-- Extends layout --}}
@extends('admin.layout.default')

{{-- Content --}}
@section('content')

<div class="container-fluid">
	<div class="row page-titles mx-0 mb-3">
        <div class="col-sm-6 p-0">
            <div class="welcome-text">
                <h4>{{ __('Themes') }}</h4>
                <span>{{ __('All Themes') }}</span>
            </div>
        </div>
        <div class="col-sm-6 p-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">{{ __('Themes') }}</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ __('All Themes') }}</a></li>
            </ol>
        </div>
    </div>

	<div class="row mb-4">
		@forelse($themes as $key => $theme)
			<div class="col-md-4">
				<div class="card">
                    <div class="card-body p-1">
                        <div class="new-arrival-product">
                            <div class="new-arrivals-img-contnent">
                                <img class="img-fluid" src="{{ route('get_file', ['vendor' => $theme->getVendor(), 'theme' => $theme->getName(), 'file' => 'screenshot.png']) }}" alt="{{ ucfirst($theme->getName()).__(' Preview Image ') }}">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer p-3 border-top d-flex align-items-center justify-content-between">
                    	<h5 class="m-0">{{ ucfirst($theme->getName()) }}</h5>
                        <div>
                        	@if ($theme->enabled())
                        		<a href="javascript:void(0);" class="btn btn-xs btn-info">{{ __('Activated') }}</a>
                        	@else
                        		<a href="{{ route('themes.admin.index') }}?activate={{ $key }}" class="btn btn-xs btn-primary light">{{ __('Active') }}</a>
                        	@endif
                        </div>
                	</div>
                </div>
			</div>
		@empty
		<div class="col-12">
			<div class="alert alert-primary text-center" role="alert">
			  	{{ __('Themes Not Found.') }}
			</div>
		</div>
		@endforelse
		
	</div>

</div>

@endsection