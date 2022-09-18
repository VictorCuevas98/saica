@extends('layout.default')
@section('content')
<!--begin::Subheader-->
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
   <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
      <!--begin::Info-->
      <div class="d-flex align-items-center flex-wrap mr-1">
         <!--begin::Page Heading-->
         <div class="d-flex align-items-baseline flex-wrap mr-5">
            <!--begin::Page Title-->
            <h6 class="text-dark font-weight-bold my-1 mr-5">Perfil de Usuario</h6>
            <!--end::Page Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-1 font-size-xs">
               <li class="breadcrumb-item text-muted">
                  <a href="" class="text-muted">Cambiar Contraseña</a>
               </li>
            </ul>
            <!--end::Breadcrumb-->
         </div>
         <!--end::Page Heading-->
      </div>
      <!--end::Info-->     
   </div>
</div>
<!--end::Subheader-->
<div class="card card-custom">
   <div class="card-header">
      <h3 class="card-title">
         Cambia tu Contraseña
      </h3>
      <div class="card-toolbar">
         <div class="example-tools justify-content-center">
            <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
            <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
         </div>
      </div>
   </div>
   <!--begin::Form-->
   <form id="kt_form" method="post" action="{{url('savePassword')}}">
      @csrf
      <div class="card-body">
         <div class="form-group mb-8">
            <div class="alert alert-custom alert-default" role="alert">
               <div class="alert-icon"><i class="flaticon-warning text-danger"></i></div>
               <div class="alert-text">
                  La contraseña debe tener mínimo 8 Dígitos(1 mayúscula, 1 minúscula, 1 número y 1 de estos caracteres especiales[ ! $ # % & . ]).
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-xl-2"></div>
            <div class="col-xl-8">
               <!--begin::Group-->
               <div class="form-group row">
                  <label class="col-form-label col-3 text-lg-right text-left">Contraseña Actual</label>
                  <div class="col-9">
                     <input class="form-control form-control-lg form-control-solid mb-1" type="password" name="passwordcurrent" id="passwordcurrent" value="{{ old('passwordcurrent') }}" placeholder="Contraseña Actual">
                  </div>
               </div>
               <!--end::Group-->
               <!--begin::Group-->
               <div class="form-group row">
                  <label class="col-form-label col-3 text-lg-right text-left">Contraseña Nueva</label>
                  <div class="col-9">
                     <input class="form-control form-control-lg form-control-solid mb-1" name="passwordnew" id="passwordnew" type="password" placeholder="Contraseña Nueva">
                  </div>
               </div>
               <!--end::Group-->
               <!--begin::Group-->
               <div class="form-group row">
                  <label class="col-form-label col-3 text-lg-right text-left">Confirme Contraseña</label>
                  <div class="col-9">
                     <input class="form-control form-control-lg form-control-solid mb-1" name="passwordconfirm" id="passwordconfirm" type="password" placeholder="Confirme Contraseña">
                  </div>
               </div>
			   <br>
               @if ($errors->any())
               <div class="alert alert-custom alert-light-danger fade show py-4" role="alert">
                  <div class="alert-text font-weight-bold">
                     <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                     </ul>
                  </div>
               </div>
               @endif
               <!--end::Group-->
            </div>
         </div>
      </div>
      <div class="card-footer">
         <div class="row">
            <div class="col-9"></div>
            <div class="col-3">
               <a href="{{url('/')}}" class="btn btn-secondary font-weight-bold text-right">Cancelar</a>
               <button type="submit" class="btn btn-success font-weight-bold text-right">Guardar</button>
            </div>
         </div>
      </div>
   </form>
   <!--end::Form-->
</div>
@endsection
@section('scripts')
@if (session('message'))
<script>
   setTimeout(function() {
       swal.fire('¡Aviso!', "{{session('message')}}", 'success');
   }, 1000);
</script>
@endif
@if (session('errorPass'))
<script>
   setTimeout(function() {
       swal.fire('¡Aviso!', "{{session('errorPass')}}", 'warning');
   }, 1000);
</script>
@endif
@endsection