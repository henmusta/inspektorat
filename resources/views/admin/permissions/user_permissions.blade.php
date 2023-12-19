{{-- Extends layout --}}
@extends('admin.layout.default')
{{-- Content --}}
@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-0">
            <div class="welcome-text">
                <h4>{{ __('Users Permissions') }}</h4>
                <span>{{ __('All users permissions list') }}</span>
            </div>
        </div>
        <div class="col-sm-6 p-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.permissions.index') }}">{{ __('Permissions') }}</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ __('Users Permissions') }}</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->
    <!-- Row starts -->
    <div class="row">
        <!-- Column starts -->
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-block">
                    <h4 class="card-title">{{ __('Roles') }}</h4>
                </div>
                <div class="pe-4 ps-4 pt-2 pb-2">
                    <div class="table-responsive">
                        <table class="table table-responsive-md mb-0">
                            <thead>
                                <tr>
                                    <th><strong>{{ __('SN.') }}</strong> </th>
                                    <th><strong>{{ __('User Name') }}</strong></th>
                                    <th><strong>{{ __('Email') }}</strong></th>
                                    <th><strong>{{ __('Actions') }}</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = $users->firstItem();
                                @endphp
                                @forelse($users as $user)
                                <tr>
                                    <td> {{ $i++ }} </td>
                                    <td> {{ $user->full_name }} </td>
                                    <td> {{ $user->email }} </td>
                                    <td>
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.permissions.manage_user_permissions', $user->id) }}">{{ __('Manage permission') }}</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3">
                                        <p class="text-center">{{ __('No users found.') }}</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection