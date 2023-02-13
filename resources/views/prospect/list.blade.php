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
                            <a href="{{ route('prospect.register') }}" class="btn btn-primary">
                                <i class="fa fa-plus"></i> Nuevo Registro
                            </a>


                            <a href="{{ route('import.excel.prospect') }}" class="btn btn-success">
                                <i class="fa fa-file-excel"></i> Importar a Excel
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
                                    <th>ID</th>
                                    <th>NOMBRE</th>
                                    <th>EMPRESA</th>
                                    <th>PAIS</th>
                                    <th>ESTADO</th>
                                    <th>CIUDAD</th>
                                    <th>TELÉFONO</th>
                                    <th>CORREO</th>
                                    <th>USUARIO</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->company_name }}</td>
                                        <td>{{ $item->country }}</td>
                                        <td>{{ $item->estate }}</td>
                                        <td>{{ $item->city }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>
                                            <div class="dropdown dropleft show">
                                                <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-cogs"></i>
                                                </a>                                            
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <li>                                                
                                                        <a class="dropdown-item" target="_blank" href="{{ route('prospect.edit',['id'=>$item->id]) }}">
                                                            Editar <i class="fas fa-pencil-alt"></i>
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
