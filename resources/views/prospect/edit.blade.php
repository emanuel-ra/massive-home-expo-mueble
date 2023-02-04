@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Prospectos</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">
                        <!-- Maximize Button -->
                        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-12">
                        <form action="{{route('prospect.register.store')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="form-group col-12">
                                    <label for="">Nombre *</label>
                                    <input type="text" class="form-control" name="name" value="{{ $data->name }}" required>
                                </div>

                                <div class="form-group col-12 col-lg-6">
                                    <label for="">Empresa</label>
                                    <input type="text" class="form-control" name="company_name" value="{{ $data->company_name }}">
                                </div>

                                <div class="form-group col-12 col-lg-3">
                                    <label for="">Telefono/Celular</label>
                                    <input type="text" class="form-control" name="phone" value="{{ $data->phone }}">
                                </div>

                                <div class="form-group col-12 col-lg-3">
                                    <label for="">Email</label>
                                    <input type="email" class="form-control" name="email" value="{{ $data->email }}">
                                </div>

                                <div class="form-group col-12 col-lg-3">
                                    <label for="">Pais</label>
                                    <input type="text" class="form-control" name="country" list="lstCountry" value="{{ $data->country }}">
                                    <datalist id="lstCountry">
                                        <option value="México">
                                        <option value="Estados Unidos">
                                        <option value="Canada">
                                        <option value="China">
                                        <option value="Japon">
                                        <option value="Corea">
                                    <datalist>
                                </div>

                                <div class="form-group col-12 col-lg-3">
                                    <label for="">Estado</label>
                                    <input type="text" class="form-control" name="estate" list="lstStates" value="{{ $data->estate }}">
                                    <datalist id="lstStates">
                                        @foreach ($states as $item => $value)
                                            <option value="{{ $value }}">
                                        @endforeach
                                    <datalist>
                                </div>

                                <div class="form-group col-12 col-lg-3">
                                    <label for="">Ciudad</label>
                                    <input type="text" class="form-control" name="city" list="lstCities" value="{{ $data->city }}">
                                    <datalist id="lstCities">
                                        @foreach ($comercialBusiness as $item => $value)
                                            <option value="{{ $value }}">
                                        @endforeach
                                    <datalist>
                                </div>

                                <div class="form-group col-12 col-lg-3">
                                    <label for="">Giro</label>
                                    <input type="text" class="form-control" name="commercial_business" list="lstComercialBusiness" value="{{ $data->commercial_business }}">
                                    <datalist id="lstComercialBusiness">
                                        @foreach ($comercialBusiness as $item => $value)
                                            <option value="{{ $value }}">
                                        @endforeach
                                    <datalist>
                                </div>

                                <div class="form-group col-12">
                                    <label for="">Direccio</label>
                                    <textarea class="form-control" name="address">{{ $data->address }}</textarea>
                                </div>

                                <div class="form-group col-12">
                                    <label for="">Observaciones</label>
                                    <textarea class="form-control" name="observations">{{ $data->observations }}</textarea>
                                </div>

                                
                            </div>

                            <div class="col-sm-12 px-0 d-flex justify-content-between">                    
                                <a href="{{ route('prospect.list') }}" class="btn btn-default">
                                    Cancelar
                                </a>
                                <button class="btn btn-primary">
                                    Guardar
                                </button>
                            </div>

                        </form>
                    </div>

                    <div class="col-12 mt-2">
                        @if ($errors->any())
                            <div class="col-12 alert alert-danger" role="alert">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if(session('success'))
                            <div class="col-12 alert alert-success" role="alert">
                                <h1>{{session('success')}} 😀👍</h1>
                            </div>                                
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop
