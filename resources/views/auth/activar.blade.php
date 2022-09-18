@extends('layouts.app_activar')

@section('content')
<div align="center">
    <img src="{{asset('')}}" style="width:520px; margin-bottom:3%;" class="max-h-120px" alt="">
</div>
<div class="container" >
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3>Concluye el registro en el sistema de {{env('APP_NAME')}}</h3></div>

                <div class="card-body">
                    
                    <form method="POST" action="{{ url('activarUsuario') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="rfc" class="col-md-4 col-form-label text-md-right">RFC</label>
                            <div class="col-md-6">
                                <input id="rfc" type="text" class="form-control" name="rfc" value="{{$datosUsuario[0]->rfc}}" readonly>
                                <input type="hidden" value="{{$id_usuario}}" id="hashid" name="hashid">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Contraseña</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">
                                <span id="passstrength"></span>
                                <div id="passTest"></div>
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
                                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                                <div id="passVal"></div>
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
@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<script>
$('#password').keyup(function(e) {
     var strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");
     var mediumRegex = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");
     var enoughRegex = new RegExp("(?=.{3,}).*", "g");
     if (false == enoughRegex.test($(this).val())) {
             $('#passTest').removeClass();
             $('#passstrength').html('Más caracteres.');
     } else if (strongRegex.test($(this).val())) {
             $('#passstrength').html('');
             $('#passTest').removeClass();
             $('#passTest').addClass('bg-light-success','rounded-xl','px-6','py-8');
             $('#passTest').html('<span class="text-success font-weight-bold font-size-h6">Fuerte</span>');
     } else if (mediumRegex.test($(this).val())) {
             $('#passstrength').html('');
             $('#passTest').removeClass();
             $('#passTest').addClass('bg-light-warning','rounded-xl','px-6','py-8');
             $('#passTest').html('<span class="text-warning font-weight-bold font-size-h6">Media</span>');
     } else {
             $('#passstrength').html('');
             $('#passTest').removeClass();
             $('#passTest').addClass('bg-light-danger','rounded-xl','px-6','py-8');
             $('#passTest').html('<span class="text-danger font-weight-bold font-size-h6">Debil</span>');
     }
     return true;
});

$('#password_confirmation').keyup(function(e){
    if($('#password').val() != $('#password_confirmation').val()){
        $('#passVal').removeClass();
        $('#passVal').addClass('bg-light-warning','rounded-xl','px-6','py-8');
        $('#passVal').html('<span class="text-warning font-weight-bold font-size-h6">Las contraseñas no coinciden</span>');
    }else if($('#password').val() == $('#password_confirmation').val()){
        $('#passVal').removeClass();
        $('#passVal').addClass('bg-light-success','rounded-xl','px-6','py-8');
        $('#passVal').html('<span class="text-success font-weight-bold font-size-h6">Coinciden</span>');
    }
    return true;
});

</script>
@endsection