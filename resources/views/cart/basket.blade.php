@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Nueva Cotización</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            
            <div class="col-12 mb-2 px-0">
                <div class="row">
                    <div class="col btn-group">
                        <a href="{{ route('cart.price',['type'=>1]) }}" class="btn btn-info">Precio Menudeo</a>
                        <a href="{{ route('cart.price',['type'=>2]) }}" class="btn btn-warning">Precio Mayoreo</a>
                        <a href="{{ route('cart.price',['type'=>3]) }}" class="btn btn-primary">Precio Distribuidor</a>
                        <a href="{{ route('cart.price',['type'=>4]) }}" class="btn btn-success">Precio Caja</a>
                    </div>
                    <div class="col">
                        <a href="javascript:openModal()" class="btn btn-primary">
                            Articulos
                        </a>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="card-tools">
                        <!-- Maximize Button -->
                        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                    </div>

                    <h2><span class="badge badge-primary">{{ $prices_labels[$type_price] }}</span></h2>
                </div>


                <div class="card-body">                    
                    <div class="col-12">

                        <div class="row">
                            
                        </div>

                        <form action="{{route('prospect.register.store')}}" method="post">
                            @csrf
                            <div class="row">                               
                                <div class="col-12 col-lg-6">
                                    @foreach ($cart as $item)
                                        <div class="card col-12">  
                                            <div class="row">
                                                <div class="col-12 col-lg-2 p-2">
                                                    <img src="{{ asset("images/products") }}/{{$item->associatedModel->image}}" alt="{{$item->associatedModel->image}}" style="width:100px;" onerror="this.src='{{ asset('images/image_not_found.png') }}';">
                                                </div>
                                                <div class="col-12 col-lg-6">
                                                    <b>{{$item->associatedModel->code}}</b> <br>
                                                    <span class="text-gray">{{$item->name}}</span>
                                                </div>
                                                <div class="col-12 col-lg-4">

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="col-12 col-lg-6">
                                </div>
                            </div>

                            <div class="col-sm-12 px-0 d-flex justify-content-between">                    
                                <a href="{{ route('prospect.list') }}" class="btn btn-default">
                                    Cancelar
                                </a>
                                <button class="btn btn-primary">
                                    Continuar
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

