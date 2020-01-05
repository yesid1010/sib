@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Confirmar Contraseña') }}</div>

                <div class="card-body">
                    {{ __('Para poder realizar esta acción debe confirmar su contraseña.') }}
                    {{ __('No se le volverá a preguntar durante las proximas 3 horas') }}
                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="form-group row">

                            <div class="col-md-6 offset-md-3">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror " name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Confirmar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
