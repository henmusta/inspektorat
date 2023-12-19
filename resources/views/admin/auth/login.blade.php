@extends('admin.layout.fullwidth')

@section('content')


<div class="col-xl-12 mt-3">
    <div class="card">
        <div class="card-body p-0">
            <div class="row m-0">
                <div class="col-xl-6 col-md-6 sign text-center">
                    <div>
                        <div class="text-center my-5">
                            <img class="logo-abbr max-width-180" src="{{ DzHelper::siteLogo() }}" alt="{{ __('Logo') }}">
                        </div>
                        <img src="{{ asset('images/log.png') }}" class="education-img w-100">
                    </div>
                </div>
                <div class="col-md-6 authincation-content">
                    <div class="">
                        <div class="row no-gutters">
                            <div class="auth-form">

                                <h4 class="">Login</h4>
                                <span class="fs-14 d-block mb-4">Masukan Email Dan Password<br></span>
                                <form id="formStore" class="custom-form mt-4 pt-2 login" method="POST" action="{{ route('admin.login') }}">
                                    @csrf

                                    <div class="form-group ">
                                        <label for="login_email" class="mb-1"><strong>{{ __('E-Mail') }}</strong></label>
                                        <input id="login_email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                                   value="{{ old('email') }}" required>

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="login_password" class="mb-1"><strong>{{ __('Password') }}</strong></label>
                                        <input id="login_password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>



                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary btn-block">{{ __('Sign In') }}</button>
                                    </div>
                                </form>
                                {{-- @if (Route::has('register'))
                                    <div class="new-account mt-3">
                                        <p>{{ __("Don't have an account?") }} <a class="text-primary" href="{{ url('/register') }}">{{ __('Sign up') }}</a></p>
                                    </div>
                                @endif --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

@section('script')
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
            btnSubmit.removeClass("disabled").html(btnSubmitHtml).removeAttr("disabled");
            let errorCreate = $('#errorCreate');
            errorCreate.css('display', 'none');
            errorCreate.find('.alert-text').html('');
            if (response.status === "success") {
                toastr.success(response.message, 'Success !');
                window.location.href = response.redirect;
            } else {
                Swal.fire({
                    title: 'Gagal Untuk Login!',
                    text: response.message,
                    icon: response.status,
                    confirmButtonText: 'Ok'
                }).then(function() {
                    window.location.reload();
                });
            }
          },
          error: function (response) {
            btnSubmit.removeClass("disabled").html(btnSubmitHtml).removeAttr("disabled");
                Swal.fire({
                    title: 'Gagal Untuk Login Perikasa Email Dan Password!',
                    text: response.message,
                    icon: 'error',
                    confirmButtonText: 'Ok'
                }).then(function() {
                    window.location.reload();
                });
          }
        });
    });

});
</script>

@endsection
