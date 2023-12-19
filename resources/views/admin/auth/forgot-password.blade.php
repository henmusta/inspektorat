@extends('admin.layout.fullwidth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    {{-- <div class="card-header">

                    </div> --}}
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="mb-4 text-center">
                                <img class="logo-abbr  mb-3"  width="265" src="{{ DzHelper::siteLogo() }}" alt="{{ __('Logo') }}">
                                <h4 class="form-title">{{ __('Forget Password') }}</h4>
                            </div>
                            <div class="form-group row">
                                <p>{{ __('Enter your e-mail address below to reset your password.') }}</p>
                                <div class="col-12">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('Enter Email ...') }}" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Send') }}
                                    </button>
                                    <a class="btn btn-primary ms-2 float-end" href="{{ url('/login') }}">{{ __('back') }} </a>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection