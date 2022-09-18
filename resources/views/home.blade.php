@extends('layout.default')


@section('content')
<div class="">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Inicio</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h2></h2>
                    <img src="{{asset('/media/bg/DISENO-SIST-SAICA-7-01.svg')}}">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
