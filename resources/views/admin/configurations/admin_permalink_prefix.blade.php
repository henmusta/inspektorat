{{-- Extends layout --}}
@extends('admin.layout.default')

{{-- Content --}}
@section('content')

<div class="container-fluid">
    <div class="row page-titles mx-0 mb-3">
        <div class="col-sm-6 p-0">
            <div class="welcome-text">
                <h4>{{ __('Configurations') }}</h4>
                <span>{{ Str::ucfirst($prefix) }} {{ __('configuration') }}</span>
            </div>
        </div>
        <div class="col-sm-6 p-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.configurations.admin_index') }}">{{ __('Configurations') }}</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ Str::ucfirst($prefix) }}</a></li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ Str::ucfirst($prefix) }} {{ __('Configuration') }}</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{ route('admin.configurations.save_permalink', $prefix) }}" method="post" enctype="multipart/form-data">
                        @csrf
							<div class="form-group mb-3">
								<div class="radio">
									<label><input type="radio" name="permalink_selection" class="permalink_selection form-check-input m-0 me-1" id="Plain" value="" {{ empty($configuration->value) ? 'checked="checked"' : '' }}> {{ __('Plain') }}</label>
									<code> {{ url('/') }}/?p=123</code>
								</div>
								<div class="radio">
									<label><input type="radio" name="permalink_selection" class="permalink_selection form-check-input m-0 me-1" id="DayName" value="/%year%/%month%/%day%/%slug%/" {{ ($configuration->value == '/%year%/%month%/%day%/%slug%/') ? 'checked="checked"' : '' }}> {{ __('Day and name') }}</label>
									<code> {{ url('/') }}/{{ date("Y") }}/{{ date("m") }}/{{ date("d") }}/sample-post/</code>
								</div>
								<div class="radio">
									<label><input type="radio" name="permalink_selection" class="permalink_selection form-check-input m-0 me-1" id="MonthName" value="/%year%/%month%/%slug%/" {{ ($configuration->value == '/%year%/%month%/%slug%/') ? 'checked="checked"' : '' }}> {{ __('Month and name') }}</label>
									<code> {{ url('/') }}/{{ date("Y") }}/{{ date("m") }}/sample-post/</code>
								</div>
								<div class="radio">
									<label><input type="radio" name="permalink_selection" class="permalink_selection form-check-input m-0 me-1" id="Numeric" value="/archives/%post_id%" {{ ($configuration->value == '/archives/%post_id%') ? 'checked="checked"' : '' }}> {{ __('Numeric') }}</label>
									<code> {{ url('/') }}/archives/123</code>
								</div>
								<div class="radio">
									<label><input type="radio" name="permalink_selection" class="permalink_selection form-check-input m-0 me-1" id="PostName" value="/%slug%/" {{ ($configuration->value == '/%slug%/') ? 'checked="checked"' : '' }}> {{ __('Post name') }}</label>
									<code> {{ url('/') }}/sample-post/</code>
								</div>
								<div class="radio">
									<label>
										<input type="radio" name="permalink_selection" class="permalink_selection form-check-input m-0 me-1" id="CustomeStructure" value="custom" {{ (!empty($configuration->value) && !in_array($configuration->value, $routesType)) ? 'checked="checked"' : '' }}> {{ __('Custom Structure') }}
									</label>
									<code> {{ url('/') }} </code> <input name="permalink_structure" id="permalink_structure" type="text" value="{{ $configuration->value }}" class="form-control col-md-6">
								</div>
							</div>
							<ul role="list">
								<li class="d-inline-block mb-1">
									@php
										$activeClass = (strpos($configuration->value, '%year%') > -1) ? 'active' : '';
									@endphp
									<button type="button" class="btn btn-sm btn-outline-dark permas_type {{ $activeClass }}" value="%year%" data-label="{{ __('year (The year of the post, four digits, for example 2004.)') }}">
									{{ __('%year%') }}</button>
								</li>
								<li class="d-inline-block mb-1">
									@php
										$activeClass = (strpos($configuration->value, '%month%') > -1) ? 'active' : '';
									@endphp
									<button type="button" class="btn btn-sm btn-outline-dark permas_type {{ $activeClass }}" value="%month%" data-label="{{ __('monthnum (Month of the year, for example 05.)') }}">
									{{ __('%month%') }}</button>
								</li>
								<li class="d-inline-block mb-1">
									@php
										$activeClass = (strpos($configuration->value, '%day%') > -1) ? 'active' : '';
									@endphp
									<button type="button" class="btn btn-sm btn-outline-dark permas_type {{ $activeClass }}" value="%day%" data-label="{{ __('day (Day of the month, for example 28.)') }}">
									{{ __('%day%') }}</button>
								</li>
								<li class="d-inline-block mb-1">
									@php
										$activeClass = (strpos($configuration->value, '%hour%') > -1) ? 'active' : '';
									@endphp
									<button type="button" class="btn btn-sm btn-outline-dark permas_type {{ $activeClass }}" value="%hour%" data-label="{{ __('hour (hour of the day, for example 14.)') }}">
									{{ __('%hour%') }}</button>
								</li>
								<li class="d-inline-block mb-1">
									@php
										$activeClass = (strpos($configuration->value, '%minute%') > -1) ? 'active' : '';
									@endphp
									<button type="button" class="btn btn-sm btn-outline-dark permas_type {{ $activeClass }}" value="%minute%" data-label="{{ __('minute (minute of the hours, for example 32.)') }}">
									{{ __('%minute%') }}</button>
								</li>
								<li class="d-inline-block mb-1">
									@php
										$activeClass = (strpos($configuration->value, '%second%') > -1) ? 'active' : '';
									@endphp
									<button type="button" class="btn btn-sm btn-outline-dark permas_type {{ $activeClass }}" value="%second%" data-label="{{ __('second (second of the minutes, for example 35.)') }}">
									{{ __('%second%') }}</button>
								</li>
								<li class="d-inline-block mb-1">
									@php
										$activeClass = (strpos($configuration->value, '%post_id%') > -1) ? 'active' : '';
									@endphp
									<button type="button" class="btn btn-sm btn-outline-dark permas_type {{ $activeClass }}" value="%post_id%" data-label="{{ __('post_id added to permalink structure') }}">
									{{ __('%post_id%') }}</button>
								</li>
								<li class="d-inline-block mb-1">
									@php
										$activeClass = (strpos($configuration->value, '%slug%') > -1) ? 'active' : '';
									@endphp
									<button type="button" class="btn btn-sm btn-outline-dark permas_type {{ $activeClass }}" value="%slug%" data-label="{{ __('postname (The sanitized post title (slug).)') }}">
									{{ __('%slug%') }}</button>
								</li>
								<li class="d-inline-block mb-1">
									@php
										$activeClass = (strpos($configuration->value, '%category%') > -1) ? 'active' : '';
									@endphp
									<button type="button" class="btn btn-sm btn-outline-dark permas_type {{ $activeClass }}" value="%category%" data-label="{{ __('category added to permalink structure') }}">
									{{ __('%category%') }}</button>
								</li>
								<li class="d-inline-block mb-1">
									@php
										$activeClass = (strpos($configuration->value, '%author%') > -1) ? 'active' : '';
									@endphp
									<button type="button" class="btn btn-sm btn-outline-dark permas_type {{ $activeClass }}" value="%author%" data-label="{{ __('author added to permalink structure') }}">
									{{ __('%author%') }}</button>
								</li>
							</ul>
							<button type="submit" class="btn btn-primary mt-3 py-2">{{ __('Save') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection