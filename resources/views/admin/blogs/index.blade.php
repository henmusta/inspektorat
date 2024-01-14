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
						<table id="Datatable" class="table table-responsive-lg mb-0" width="100%">
							<thead class="">
								<tr>
									{{-- <th> <strong> {{ __('S.N.') }} </strong> </th> --}}
									<th> <strong>Judul</strong> </th>
									<th> <strong>Penulis</strong> </th>
									<th> <strong>Status</strong> </th>
									<th> <strong>Created</strong> </th>
                                    <th class="text-center"><strong>Aksi</strong></th>
								</tr>
							</thead>
							<tbody>

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
            url: "{{ route('blog.admin.index') }}",
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
