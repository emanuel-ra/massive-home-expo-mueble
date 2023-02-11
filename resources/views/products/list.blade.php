@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Productos</h1>
@stop

@section('content')
    <div class="row">

        @if(session('success'))
            <div class="col-12 alert alert-success" id="success_alert" role="alert">
                <h1>{{session('success')}}</h1>
            </div>          
        @endif
        
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
                    </div>

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
                                        <td>$ {{ number_format($item->price1,2,'.',',') }}</td>
                                        <td>$ {{ number_format($item->price2,2,'.',',') }}</td>
                                        <td>$ {{ number_format($item->price3,2,'.',',') }}</td>
                                        <td>$ {{ number_format($item->price4,2,'.',',') }}</td>
                                        <td>
                                            <div style="width: 100px;">
                                                <img src="{{ asset("images/products/$item->image") }}" onerror="this.src='{{ asset('images/image_not_found.png') }}';" class="img-thumbnail img-fluid" alt="{{ $item->image }}">
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

                                                        <a class="dropdown-item" href="{{ route('cart.add',['product_id'=>$item->id]) }}">
                                                            Agregar al Carrito <i class="fas fa-cart-plus text-info"></i>
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

    @if(session('success'))
    
        @section('js')
            <script>
               setTimeout(() => {
                    $("#success_alert").fadeOut('easing')
               }, 1000);
            </script>        
        @endsection
    @endif

@stop
