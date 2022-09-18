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
            <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                <li class="breadcrumb-item text-muted">
                    <span class="text-muted">Contratos abiertos</span>
                </li>
                <li class="breadcrumb-item text-muted">
                    <span class="text-muted">Carpeta</span>
                </li>
                <li class="breadcrumb-item text-muted">
                    <span class="text-muted">{{$adquisicion->num_carpeta}} </span>
                </li>
                @yield('FOC_subheader_elements')
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
            @can('entradas.contratosAbiertos.crear')
            <a href="{{route('entradas.fondoOficinas.carpeta.edit',$adquisicionId)}}" class="btn btn-success font-weight-bold btn-sm px-4 font-size-base ml-2">Carpeta</a>
            @endcan
            @if( Auth::user()->hasAnyPermission(['entradas.contratosAbiertos.lista_de_revision.listar','entradas.contratosCerrados.lista_de_revision.listar']) )
            <a href="{{route('entradas.fondoOficinas.checklist.index',$adquisicionId)}}" class="btn btn-success font-weight-bold btn-sm px-4 font-size-base ml-2">Listas de revisión</a>
            @endif
            <a href="{{route('entradas.fondoOficinas.contratos.index',$adquisicionId)}}" class="btn btn-success font-weight-bold btn-sm px-4 font-size-base ml-2">Contratos</a>
        </div>
        <!--end::Toolbar-->
    </div>
</div>
<!-- end::Subheader -->

@if(Session::has('flash'))
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="alert alert-info">
                            <strong>{{session('flash')}}</strong>
                        </div>
                    </div>              
                </div>
            </div>
        </div>
    </div>
</div>
@endif


@yield('FOC_content',\View::make('entradas.fondoOficina._estadisticas'))


<input type="hidden" name="url" id="url" value="{{url('/')}}">
<div id="" class="page-loader">
    <div class="spinner spinner-primary spinner-lg mr-10 "></div>
    <h5 id="pageloader_spinner_mesage">Cargando..</h5>
</div>

@endsection


