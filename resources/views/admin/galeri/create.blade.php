{{-- Extends layout --}}
@extends('admin.layout.default')

{{-- Content --}}
@section('content')

<div class="container-fluid">

	<div class="row page-titles mx-0 ">
		<div class="col-sm-6 p-0">
			<div class="welcome-text">
				<h4>Galeri</h4>
				<span>Tambah Galeri</span>
			</div>
		</div>
		<div class="col-sm-6 p-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ route('galeri.admin.index') }}">Galeri</a></li>
				<li class="breadcrumb-item active"><a href="javascript:void(0)">Tambah Galeri</a></li>
			</ol>
		</div>
	</div>

	<form action="{{ route('galeri.admin.store') }}" id="formStore" method="post" enctype="multipart/form-data">
		@csrf
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title">Tambah Galeri</h4>
							</div>
							<div class="card-body p-4">
								<div class="row">
									<div class="form-group col-md-12">
										<label for="BlogTitle">Judul</label>
										<input type="text" name="data[Galeri][title]" class="form-control" id="GaleriTitle" placeholder="Judul" value="">
										@error('data.Galeri.title')
											<p class="text-danger">
												{{ $message }}
											</p>
										@enderror
									</div>
									<div class="form-group col-md-4 ">
                                        <div class="card accordion accordion-rounded-stylish accordion-bordered XFeaturedImage" id="accordion-feature-image">
                                            <div class="card-header justify-content-start accordion-header" data-bs-toggle="collapse" data-bs-target="#with-feature-image" aria-expanded="true">
                                                <h4 class="card-title">Gambar</h4>
                                                <span class="accordion-header-indicator"></span>
                                            </div>
                                            <div class="accordion__body p-4 collapse show" id="with-feature-image" data-bs-parent="#accordion-feature-image">
                                                <div class="featured-img-preview img-parent-box">

                                                    <img src="{{ asset('images/noimage.jpg') }}" class="avatar img-for-onchange"  alt="{{ __('Image') }}" width="100px" height="100px" title="{{ __('Image') }}">
{{--
                                                    <input type="hidden" name="data[Galeri][title]" value="ximage" id="ContentMeta0Title"> --}}
                                                    <div class="form-file">
                                                        <input type="file" class="ps-2 form-control img-input-onchange" name="data[GaleriImage][value]" accept=".png, .jpg, .jpeg"  id="GaleriValue">
                                                    </div>
                                               </div>
                                                @error('data.Galeri.value')
                                                    <p class="text-danger">
                                                        {{ $message }}
                                                    </p>
                                                @enderror
                                            </div>
                                        </div>
									</div>
								</div>
							</div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                <a href="{{ route('galeri.admin.index') }}" class="btn btn-danger">{{ __('Back') }}</a>
                            </div>
						</div>
					</div>





				</div>
			</div>

		</div>
	</form>
</div>



@endsection
@push('inline-scripts')
{{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function () {


          $("#formStore").submit(function (e) {
            e.preventDefault();
            let form = $(this);
            let btnSubmit = form.find("[type='submit']");
            let btnSubmitHtml = btnSubmit.html();
            let url = form.attr("action");
            let data = new FormData(this);
            $.ajax({
              beforeSend: function () {
                btnSubmit.addClass("disabled").html("<span aria-hidden='true' class='spinner-border spinner-border-sm' role='status'></span> Loading ...").prop("disabled", "disabled");
              },
              cache: false,
              processData: false,
              contentType: false,
              type: "POST",
              url: url,
              data: data,
              success: function (response) {
                let errorCreate = $('#errorCreate');
                errorCreate.css('display', 'none');
                errorCreate.find('.alert-text').html('');
                btnSubmit.removeClass("disabled").html(btnSubmitHtml).removeAttr("disabled");
                if (response.status === "success") {
                  toastr.success(response.message, 'Success !');
                  setTimeout(function () {
                    if (response.redirect === "" || response.redirect === "reload") {
                      location.reload();
                    } else {
                      location.href = response.redirect;
                    }
                  }, 1000);
                } else {
                  toastr.error((response.message ? response.message : "Please complete your form"), 'Failed !');
                  if (response.error !== undefined) {
                    errorCreate.removeAttr('style');
                    $.each(response.error, function (key, value) {
                      errorCreate.find('.alert-text').append('<span style="display: block">' + value + '</span>');
                    });
                  }
                }
              },
              error: function (response) {
                btnSubmit.removeClass("disabled").html(btnSubmitHtml).removeAttr("disabled");
                toastr.error(response.responseJSON.message, 'Failed !');
              }
            });
          });
    });

    </script> --}}
@endpush
