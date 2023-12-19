{{-- Extends layout --}}
@extends('admin.layout.default')

{{-- Content --}}
@section('content')

<div class="container-fluid">
	<div class="row page-titles mx-0 mb-3">
		<div class="col-sm-6 p-0">
			<div class="welcome-text">
				<h4>Galeri</h4>
				<span>List Galeri</span>
			</div>
		</div>
		<div class="col-sm-6 p-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ route('galeri.admin.index') }}">Galeri</a></li>
				<li class="breadcrumb-item active"><a href="javascript:void(0)">List Galeri</a></li>
			</ol>
		</div>
	</div>


	<!-- row -->
	<!-- Row starts -->
	<div class="row">
		<!-- Column starts -->
	</div>

	<div class="row">
		<!-- Column starts -->
		<div class="col-xl-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Galeri</h4>
					<div>
						<a href="{{ route('galeri.admin.create') }}" class="btn btn-primary">Tambah Galeri</a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table id="Datatable" class="table table-responsive-lg" width="100%">
							<thead class="">
								<tr>
									<th> <strong>Image</strong> </th>
									<th> <strong>Keterangan</strong> </th>
									<th> <strong>Aksi</strong></th>
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
            order: [[1, 'desc']],
            lengthMenu: [[50, -1], [50, "All"]],
            pageLength: 50,
            ajax: {
            url: "{{ route('galeri.admin.index') }}",
                data: function (d) {
                }
            },
            columns: [
                {data: 'image', name: 'image'},
                {data: 'title', name: 'title'},
                {data: 'action', className:'text-center', name: 'action', orderable: false, searchable: false},
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
    // let dataTable = $('#Datatable').DataTable();
    });
</script>
@endpush
