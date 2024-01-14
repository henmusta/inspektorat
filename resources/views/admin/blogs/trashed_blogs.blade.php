{{-- Extends layout --}}
@extends('admin.layout.default')

{{-- Content --}}
@section('content')

<div class="container-fluid">
	<div class="row page-titles mx-0 mb-3">
		<div class="col-sm-6 p-0">
			<div class="welcome-text">
				<h4>Postingan</h4>
				<span>Semua Postingan</span>
			</div>
		</div>
		<div class="col-sm-6 p-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ route('blog.admin.index') }}">Postingan Trash</a></li>
				<li class="breadcrumb-item active"><a href="javascript:void(0)">Semua Postingan Trash</a></li>
			</ol>
		</div>
	</div>



	<div class="row">
		<!-- Column starts -->
		<div class="col-xl-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Semua Postingan Trash</h4>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table id="Datatable" class="table table-responsive-lg mb-0">
							<thead class="">
								<tr>
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

<div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalDeleteLabel">Hapus</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @method('DELETE')
        <div class="modal-body">
          <a href="" class="urlDelete" type="hidden"></a>
          Apa anda yakin ingin menghapus data ini?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button id="formDelete" type="button" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </div>
</div>

@endsection


@push('inline-scripts')
<script>
    $(function(){
        let modalDelete = document.getElementById('modalDelete');
        const bsDelete = new bootstrap.Modal(modalDelete);
        let dataTable = new DataTable('#Datatable', {
            responsive: true,
            scrollX: false,
            processing: true,
            serverSide: true,
            order: [[0, 'desc']],
            lengthMenu: [[50, -1], [50, "All"]],
            pageLength: 50,
            ajax: {
            url: "{{ route('blog.admin.trash_list') }}",
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
                    2: {'title': 'Draft', 'class': ' badge-danger'},
                    3: {'title': 'Warning', 'class': ' badge-warning'},
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

        modalDelete.addEventListener('show.bs.modal', function (event) {
            let button = event.relatedTarget;
            let id = button.getAttribute('data-bs-id');
            let url = button.getAttribute('data-bs-url');
            this.querySelector('.urlDelete').setAttribute('href', url);
        });
        modalDelete.addEventListener('hidden.bs.modal', function (event) {
            this.querySelector('.urlDelete').setAttribute('href', '');
        });

        $("#formDelete").click(function (e) {
            e.preventDefault();
            let form = $(this);
            let url = modalDelete.querySelector('.urlDelete').getAttribute('href');
            let btnHtml = form.html();
            let spinner = $("<span aria-hidden='true' class='spinner-border spinner-border-sm' role='status'></span>");
            $.ajax({
            beforeSend: function () {
                form.text(' Loading. . .').prepend(spinner).prop("disabled", "disabled");
            },
            type: 'GET',
            url: url,
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (response) {
            toastr.success(response.message, 'Success !');
                form.text('Submit').html(btnHtml).removeAttr('disabled');
                dataTable.draw();
                bsDelete.hide();
            },
            error: function (response) {
            toastr.error(response.responseJSON.message, 'Failed !');
                form.text('Submit').html(btnHtml).removeAttr('disabled');
                bsDelete.hide();
            }
            });
        });
    });
</script>
@endpush
