@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Cotizaciones</h1>
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
                <div class="card-body px-0">
                    {{--                     
                    <div class="col-12 mb-2">
                        <form action="{{ route('product.list') }}">
                            <div class="input-group">
                                <input type="text" class="form-control" name="keyword" value="{{ $keyword }}" placeholder="Buscador.....">
                                <span class="input-group-btn">
                                    <button class="btn btn-info btn-flat">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div> --}}

                    <div class="col-12">
                        {{ $data->links('pagination::bootstrap-4') }}
                    </div>

                    <div class="col-12 p-0">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Cliente</th>
                                    <th>Tipo de Precio</th>
                                    <th>Total</th>         
                                    <th>Registrado por</th>
                                    <th>Comentarios</th>
                                    <th>Fecha</th>
                                    <th></th>                                                                 
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->prospect->name }}</td>
                                        <td>{{ $typePrices[$item->type_price] }}</td>
                                        <td>${{ $item->total }}</td>                                        
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ $item->commentary }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>
                                            <div class="dropdown dropleft show">
                                                <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-cogs"></i>
                                                </a>                                            
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <li>                                                
                                                        <a class="dropdown-item" target="_blank" href="{{ route('quote.pdf',['id'=>$item->id]) }}">
                                                            PDF <i class="fas fa-file-pdf"></i>
                                                        </a>
                                                    </li>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="col-12">
                        {{ $data->links('pagination::bootstrap-4') }}
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop