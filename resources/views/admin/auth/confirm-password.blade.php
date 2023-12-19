{{-- Extends layout --}}
@extends('admin.layout.default')

{{-- Content --}}
@section('content')

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{ __('Confirm Password') }}</h4>
        </div>
        <div class="authincation-content">
            <div class="row no-gutters">
                <div class="col-xl-12">
                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="auth-form">
                        <h4 class="text-center mb-4">{{ __('This is a secure area of the application. Please confirm your password before continuing.') }}</h4>
                        <form method="POST" action="{{ route('admin.password.confirm') }}">
                        @csrf
                            <div class="form-group">
                                <label class="mb-1"><strong>{{ __('Password') }}</strong></label>
                                <input type="password" name="password" id="password" class="form-control" required autocomplete="current-password">
                                @error('password')
                                    <p class="text-danger"> {{ $message }} </p>
                                @enderror
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-block">{{ __('Confirm') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection