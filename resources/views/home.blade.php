@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="">
                <div class="card-body">
                    <div class="body-content">
                        <div class="content-item">
                            <img class="mx-auto img-fluid" src="/logos/cultura_logo.jpg" style="width: 400px" />
                        </div>
                        <div class="content-item">
                            <h4 class="fw-bold text-center">HOJA DE ACTUALIZACIÓN DE DATOS PERSONALES {{date("Y")}}</h4>
                            {{-- <h4 class=" text-center">MINISTERIO DE CULTURA</h4> --}}
                            {{-- <h4 class=" text-center">UNIDAD DE TALENTO HUMANO</h4> --}}
                        </div>
                    </div>
                    <div class="text-center pt-3 pb-3">
                        <a class="btn btn-normal-close mx-auto text-uppercase"
                            style="padding-left: 25px; padding-right:25px" href="/record">
                            Iniciar Registro
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection