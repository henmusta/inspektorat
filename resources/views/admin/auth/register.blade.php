@extends('admin.layout.fullwidth')

@section('content')

    <div class="col-md-6">
        <div class="authincation-content">
            <div class="row no-gutters">
                <div class="col-xl-12">
                    <div class="auth-form">
                        <div class="text-center mb-3">
                            <img class="logo-abbr max-width-180" src="{{ DzHelper::siteLogo() }}" alt="{{ __('Logo') }}">
                        </div>
                        <h4 class="text-center mb-4">{{ __('Register your account') }}</h4>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group">
                                <label for="name" class="mb-1"><strong>{{ __('Name') }}</strong></label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="{{ __('Full Name') }}" required>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group ">
                                <label for="login_email" class="mb-1"><strong>{{ __('E-Mail') }}</strong></label>
                                <input id="login_email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ old('email') }}" placeholder="{{ __('Email Adress') }}" required>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="row">

                                <div class="form-group col-md-6">
                                    <label for="password" class="mb-1"><strong>{{ __('Password') }}</strong></label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="{{ __('Password') }}" required>

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="password-confirm" class="mb-1"><strong>{{ __('Confirm Password') }}</strong></label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="{{ __('Confirm Password') }}" required>
                                    @error('password-confirm')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                            </div>

                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary btn-block">{{ __('Register') }}</button>
                            </div>
                        </form>
                        <div class="new-account mt-3">
                            <p>{{ __('Already have an account?') }} <a class="text-primary" href="{{ url('/login') }}">{{ __('Sign in') }}</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection