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
						<table id="Datatable" class="table table-responsive-lg mb-0" width="100%">
							<thead>
								<tr>
									<th> <strong> Title </strong> </th>
									<th> <strong> Penulis </strong> </th>
									<th> <strong> Status </strong> </th>
									<th> <strong> Created</strong> </th>
									<th class="text-center"> <strong> Aksi </strong> </th>
								</tr>
							</thead>
							<tbody>
								{{-- @php
									$i = $pages->firstItem();
								@endphp --}}
								{{-- @forelse ($pages as $page)
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
								@endforelse --}}

							</tbody>
						</table>
					</div>
				</div>
				<div class="card-footer">

				</div>
			</div>
		</div>
	</div>

</div>


@endsection

@push('inline-scripts')
<script>
    $(function(){

        let dataTable = new DataTable('#Datatable', {
            responsive: true,
            scrollX: false,
            processing: true,
            serverSide: true,
            order: [[0, 'desc']],
            lengthMenu: [[50, -1], [50, "All"]],
            pageLength: 50,
            ajax: {
            url: "{{ route('page.admin.index') }}",
                data: function (d) {
                }
            },
            columns: [
                {data: 'title', name: 'title'},
                {data: 'user_name', name: 'user_name'},
                {data: 'status', name: 'status'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', className:'text-center', name: 'action', orderable: false, searchable: false},
            ],
            columnDefs: [
            {
                className: 'dt-center',
                targets: 2,
                render: function (data, type, full, meta) {
                let status = {
                    0: {'title': 'Draft', 'class': ' badge-danger'},
                    2: {'title': 'Warning', 'class': ' badge-warning'},
                    1: {'title': 'Publish', 'class': ' badge-success'},
                };
                if (typeof status[data] === 'undefined') {
                    return data;
                }
                return '<span class="badge ' + status[data].class + '">' + status[data].title +
                    '</span>';
                },
            },
        ],
        });

    });
</script>
@endpush
