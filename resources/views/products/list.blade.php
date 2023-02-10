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

                    <div class="row">
                        <div class="col-12">
                            <a href="{{ route('product.list') }}" class="btn btn-primary">
                                <i class="fas fa-list"></i>
                            </a>

                            <a href="{{ route('product.list') }}" class="btn btn-primary">
                                <i class="fas fa-table"></i>
                            </a>
                        </div>
                    </div>

                </div>
                <div class="card-body px-0">

                    <div class="col-12">
                        {{ $data->links('pagination::bootstrap-4') }}
                    </div>

                    <div class="col-12 p-0">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>CODIGO</th>
                                    <th>DESCRIPCION</th>
                                    <th>MENUDEO</th>
                                    <th>MAYOREO</th>
                                    <th>DISTRIBUIDOR</th>
                                    <th>CAJA</th>     
                                    <th>IMAGEN</th>  
                                    <th></th>                                                                 
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $item->code }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->price1 }}</td>
                                        <td>{{ $item->price2 }}</td>
                                        <td>{{ $item->price3 }}</td>
                                        <td>{{ $item->price4 }}</td>
                                        <td>
                                            <div style="width: 100px;">
                                                <img src="{{ asset("images/products/$item->image") }}" class="img-thumbnail img-fluid" alt="{{ $item->image }}">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="dropdown dropleft show">
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
