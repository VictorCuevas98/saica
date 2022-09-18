@extends('layouts.app_activar')

@section('content')
<div align="center">

    <img src="{{asset('media/logos/LOG-GOB-SECRETARIA-DE-SALUD.png')}}" style="width:520px; margin-bottom:3%;" class="max-h-120px" alt="">


</div>
<div class="container" >
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3>Crea una nueva contraseña</h3></div>

                <div class="card-body">
                    
                    <form method="POST" action="{{ url('changePwd') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="rfc" class="col-md-4 col-form-label text-md-right">RFC</label>
                            <div class="col-md-6">
                                <input id="rfc" type="text" class="form-control" name="rfc" value="{{$userRemember[0]->rfc}}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Contraseña</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">
                                <span class="form-text text-muted">La contraseña debe tener mínimo 8 Digitos(1 mayuscula, 1 minuscula, 1 número y 1 de estos caracteres especiales[ ! $ # % & . ]).</span>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirma contraseña</label>

                            <div class="col-md-6">
                                <input id="passwordconfirma" type="password" class="form-control" name="passwordconfirma"  autocomplete="new-password">
                                @error('password-confirm')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                @if (session('errorPass'))
                                    <br>
                                    <div class="alert alert-warning" role="alert">
                                    {{session('errorPass')}}
                                    </div>  
                                @endif

                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                    Registrar
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
