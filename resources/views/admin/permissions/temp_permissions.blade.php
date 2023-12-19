{{-- Extends layout --}}
@extends('admin.layout.default')

{{-- Content --}}
@section('content')

<div class="container-fluid">
	<div class="row page-titles mx-0">
		<div class="col-sm-6 p-0">
			<div class="welcome-text">
				<h4>{{ __('Permission Managment Tool') }}</h4>
				<span>{{ __('All temp permission listing') }}</span>
			</div>
		</div>
		<div class="col-sm-6 p-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ route('admin.permissions.index') }}">{{ __('Permissions') }}</a></li>
				<li class="breadcrumb-item active"><a href="javascript:void(0)">{{ __('Permission Managment Tool') }}</a></li>
			</ol>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="card">
                <div class="card-header d-block">
                    <h4 class="card-title mb-3">{{ __('Permission Managment Tool') }}</h4>
                    <div>
	                    <a href="{{ route('admin.permissions.add_to_permissions') }}" class="btn btn-primary">{{ __('Add to Permissions') }}</a>
	                    <a href="{{ route('admin.permissions.generate_permissions') }}" class="btn btn-primary">{{ __('Sync Temp Permissions (Remove & Regenerate Temp Permission)') }}</a>
                    </div>
                </div>
                @if(($tempPermissionsCount > 0) && ($permissionsCount == $tempPermissionsCount))
	                <div class="alert alert-info mt-3 me-3 ms-3 mb-0">
	                	{{ __('All permission generated') }}
	                </div>
	            @endif
				<div id="dz_tree" class="tree-demo card-body">
					<ul>
						@foreach($moduleTempPermissions as $modulePermissionKey => $modulePermissionValue)
							<li data-jstree='{ "selected" : false }'> {{ $modulePermissionKey }} 
								@foreach($modulePermissionValue as $controllerPermissionKey => $controllerPermissionValue)
									<ul>
										<li data-jstree='{"selected" : false}'>{{ $controllerPermissionKey }}
											@foreach($controllerPermissionValue as $actionPermissionKey => $actionPermissionValue)
												<ul>
													@php
														$addPermissionBtn = __('Add');
													@endphp
													@foreach ($actionPermissionValue as $actionPermission)
														@if(in_array($actionPermission->id, $permissionsArr))
															@php
																$permissionClass = 'added-permission';
																$addPermissionBtn = '<span class="bg-info">'.__("Added").'</span>';
															@endphp
														@else
															@php
																$permissionClass = 'not-added-permission';
																$addPermissionBtn = '<a href="'.route('admin.permissions.add_to_permissions').'">'.__("Add").'</a>';
															@endphp
														@endif
														
														<li data-jstree='{"icon":{{ asset('images/jstree_setting_icon.svg') }}}' class="{{ $actionPermission->id }} {{ $permissionClass }}">
															{{ $actionPermission->name }}
														</li>
													@endforeach
												</ul>
											@endforeach
										</li>
									</ul>
								@endforeach
							</li>
						@endforeach
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- Row ends -->
</div>


@endsection