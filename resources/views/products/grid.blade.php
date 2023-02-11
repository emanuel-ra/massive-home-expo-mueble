@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Productos</h1>
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

                    <div class="row">
                        <div class="col-12">
                            <a href="{{ route('product.list') }}" class="btn btn-primary">
                                <i class="fas fa-list"></i>
                            </a>

                            <a href="{{ route('product.grid') }}" class="btn btn-primary">
                                <i class="fas fa-table"></i>
                            </a>
                        </div>
                    </div>

                </div>
                <div class="card-body px-0">

                    <div class="col-12 mb-2">
                        <form action="{{ route('product.grid') }}">
                            <div class="input-group">
                                <input type="text" class="form-control" name="keyword" value="{{ $keyword }}" placeholder="Buscador.....">
                                <span class="input-group-btn">
                                    <button class="btn btn-info btn-flat">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>

                    <div class="col-12">
                        {{ $data->links('pagination::bootstrap-4') }}
                    </div>

                    <div class="col-12">
                        <div class="row">
                            @foreach ($data as $item)
                                <div class="col-6 col-lg-2">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ asset("images/products/$item->image") }}" onerror="this.src='{{ asset('images/image_not_found.png') }}';" alt="{{ $item->image }}">
                                        <div class="card-body">
                                            <h5 class="card-title"><b>{{ $item->code }}</b></h5>
                                            <p class="card-text">{{ $item->name }}</p>                                            
                                        </div>
                                        <table class="table table-striped">
                                            <tr>
                                                <td>Menudeo</td>
                                                <td>$ {{ number_format($item->price1,2,'.',',') }}</td>
                                            </tr>
                                            <tr>
                                                <td>Mayoreo</td>
                                                <td>$ {{ number_format($item->price2,2,'.',',') }}</td>
                                            </tr>
                                            <tr>
                                                <td>Distribuidor</td>
                                                <td>$ {{ number_format($item->price3,2,'.',',') }}</td>
                                            </tr>
                                            <tr>
                                                <td>Caja</td>
                                                <td>$ {{ number_format($item->price4,2,'.',',') }}</td>
                                            </tr>
                                        </table>
                                        <div class="col-12 p-2">
                                            <div class="dropdown dropdown show">
                                                <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-cogs"></i>
                                                </a>                                            
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <li>                                                
                                                        <a class="dropdown-item" target="_blank" href="{{ route('product.view',['id'=>$item->id]) }}">
                                                            Ficha Tecnica <i class="fas fa-file-contract"></i>
                                                        </a>
                                                    </li>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="col-12">
                        {{ $data->links('pagination::bootstrap-4') }}
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop
