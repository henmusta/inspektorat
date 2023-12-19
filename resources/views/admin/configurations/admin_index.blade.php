{{-- Extends layout --}}
@extends('admin.layout.default')

{{-- Content --}}
@section('content')

<div class="container-fluid">
    <div class="row page-titles mx-0 mb-3">
        <div class="col-sm-6 p-0">
            <div class="welcome-text">
                <h4>{{ __('Configurations') }}</h4>
                <span>{{ __('All configurations') }}</span>
            </div>
        </div>
        <div class="col-sm-6 p-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.configurations.admin_index') }}">{{ __('Configurations') }}</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ __('All configurations') }}</a></li>
            </ol>
        </div>
    </div>

    <div class="row">
        <!-- Column starts -->
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ __('Configurations') }}</h4>
                    <a href="{{ route('admin.configurations.admin_add') }}" class="btn btn-primary">{{ __('Add Configuration') }}</a>
                </div>
                <div class="pe-4 ps-4 pt-2 pb-2">
                    <div class="table-responsive">
                        <table class="table table-responsive-lg mb-0">
                            <thead>
                                <tr>
                                    <th> <strong> {{ __('Name') }} </strong> </th>
                                    <th> <strong> {{ __('Value') }} </strong> </th>
                                    <th class="text-center" width="150px"> <strong> {{ __('Actions') }} </strong> </th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($configurations as $configuration)
                                    <tr>
                                        <td> {{ $configuration->name }} </td>
                                        <td> {!! $configuration->value !!} </td>
                                        <td width="150px">
                                            <a href="{{ route('admin.configurations.admin_moveup', $configuration->id) }}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-chevron-up" aria-hidden="true"></i></a>
                                            <a href="{{ route('admin.configurations.admin_movedown', $configuration->id) }}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-chevron-down" aria-hidden="true"></i></a>
                                            <a href="{{ route('admin.configurations.admin_edit', $configuration->id) }}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fas fa-pencil-alt"></i></a>
                                            <a href="{{ route('admin.configurations.admin_delete', $configuration->id) }}" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">
                                            <p>{{ __('No configurations found') }}</p>
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    {{ $configurations->links() }}
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
