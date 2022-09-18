@extends('layout.default')



@section('content')
<div >
    @if(count( $errors ) > 0)
       @foreach ($errors->all() as $error)
          <!-- Alert with image / icon -->
            <div class="alert alert-danger"> <img src="{{asset('xtreme-admin/assets/images/users/1.jpg')}}" width="30" class="rounded-circle" alt="img"> {{ $error }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
            </div>
      @endforeach
    @endif
</div>

<!-- begin::Subheader -->
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Details-->
        <div class="d-flex align-items-center flex-wrap mr-2">
            <!--begin::Title-->
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Entradas</h5>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                <li class="breadcrumb-item text-muted">
                    <span class="text-muted">Fondo de Oficinas Centrales</span>
                </li>
            </ul>
            <!--end::Breadcrumb-->
            <!--begin::Separator-->
            <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
            <!--end::Separator-->
        </div>
        <!--end::Details-->
        <!--begin::Toolbar-->
        <div class="d-flex align-items-center">
            <!--begin::Button-->
                <a  href="{{route('entradas.fondoOficinas.checklist.index',$adquisicionId)}}" class="btn btn-success font-weight-bold btn-sm px-4 font-size-base ml-2" >Regresar</a>
            <!--end::Button-->

        </div>
        <!--end::Toolbar-->
    </div>
</div>
<!-- end::Subheader -->


<div class="row">
    <div class="col-lg-12">
        
        @if(Session::has('flash'))
        <div class="card">
            <div class="card-body">
                <div class="row">
                        <div class="col-sm-12">
                            <div class="alert alert-success">
                                <strong>{{session('flash')}}</strong>
                            </div>
                        </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        
                    </div>
                </div>
            </div>
        </div>
        @endif


        <div class="card card-custom gutter-b">
         <div class="card-header">
          <div class="card-title">
           <h3 class="card-label">
            Revisión: {{$entrada->folio_entrada}}
            <small></small>
           </h3>
          </div>
         </div>
         <div class="card-body">
          @include('entradas.fondoOficina.checklist._show',['entrada'=>$entrada,'catTiposRevision'=>$catTiposRevision])
         </div>
        </div>
    </div>
</div>
@endsection