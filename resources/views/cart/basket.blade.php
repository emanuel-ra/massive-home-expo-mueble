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
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCustomer">
                            Cliente
                        </button>
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
                    <h3>
                        @if($prospect)
                            <span class="badge badge-info">{{ $prospect->name }}</span>
                            <a href="{{ route('cart.prospect.remove') }}">
                                <i class="fa fa-times text-danger"></i>
                            </a>
                        @endif
                    </h3>
                    
                </div>


                <div class="card-body">                    
                    <div class="col-12">
                      
                        <div class="row">                               
                            <div class="col-12 col-lg-6">
                                @foreach ($cart as $item)
                                    <div class="card col-12">  
                                        <div class="row">
                                            <div class="col-12 col-lg-2 p-2">
                                                <img src="{{ asset("images/products") }}/{{$item->associatedModel->image}}" alt="{{$item->associatedModel->image}}" style="width:100px;" onerror="this.src='{{ asset('images/image_not_found.png') }}';">
                                            </div>
                                            <div class="col-12 col-lg-4">
                                                <b>{{$item->associatedModel->code}}</b> <br>
                                                <span class="text-gray">{{$item->name}}</span> <br>
                                                <a href="{{ route('cart.remove',['id'=>$item->id]) }}" class="text-danger" title="Eliminar Articulo">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                            </div>
                                            <div class="col-12 col-lg-2">
                                                <form action="{{ route('cart.update') }}">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$item->id}}" >
                                                    <label for="">Cant.</label>
                                                    <input type="number" min="1" name="qty" class="form-control" value="{{$item->quantity}}">
                                                </form>
                                            </div>
                                            <div class="col-12 col-lg-4 p-0">
                                                <table class="table table-striped">
                                                    <tr>
                                                        <td>Precio</td>                                                            
                                                        <td> $
                                                            @if ($type_price==1)
                                                                {{ number_format($item->price,2) }} 
                                                            @endif
                                                            @if ($type_price==2)
                                                                {{ number_format($item->associatedModel->price2,2) }} 
                                                            @endif
                                                            @if ($type_price==3)
                                                                {{ number_format($item->associatedModel->price3,2) }} 
                                                            @endif
                                                            @if ($type_price==4)
                                                                {{ number_format($item->associatedModel->price4,2) }} 
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Total</td>                                                            
                                                        <td> $
                                                            @if ($type_price==1)
                                                                {{ number_format($item->price*$item->quantity,2) }} 
                                                            @endif
                                                            @if ($type_price==2)
                                                                {{ number_format($item->associatedModel->price2*$item->quantity,2) }} 
                                                            @endif
                                                            @if ($type_price==3)
                                                                {{ number_format($item->associatedModel->price3*$item->quantity,2) }} 
                                                            @endif
                                                            @if ($type_price==4)
                                                                {{ number_format($item->associatedModel->price4*$item->quantity,2) }} 
                                                            @endif
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="alert alert-primary">
                                    <h3>Total: ${{ number_format($total,2) }} </h3>
                                </div>
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

                    </div>
                    
                    
                    <!-- Modal -->
                    <div class="modal fade" id="modalCustomer" tabindex="-1" role="dialog" aria-labelledby="modalCustomerLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title" id="modalCustomerLabel">Cliente</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <input type="text" class="form-control" id="keywords_modal">
                                <button class="btn btn-block btn-primary mt-2" onclick="findCustomer()"><i class="fa fa-search"></i></button>

                                <div class="col-12" id="modal_container"></div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                            </div>
                        </div>
                        </div>
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

@section('js')
<script>
   function findCustomer(){
        let keywords_modal = $("#keywords_modal").val();
        $.ajax({
            type:"POST" ,
            data:`_token={{ csrf_token() }}&keyword=${keywords_modal}`,
            dataType:'json' ,
            url:`{{ route('ajax.prospect') }}`,
            success:function(data){
                let id = 0;
                let html = `<table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>`;
                data.forEach(element => {
                    //console.log(element.name)
                    id = element.id;

                    html += `
                        <tr>
                            <td>${element.name}</td>
                            <td>
                                <form method="post" action="{{ route('cart.prospect') }}">
                                @csrf
                                <input type="hidden" name="id" value="${id}" >
                                <button class="btn btn-primary">Seleccionar</button>
                                </form>
                            </td>
                        </tr>`;

                });

                html += `</tbody></table>`;

                $("#modal_container").html(html);
            }
        })

        function selectCustomer(){

        }
   }
</script>        
@endsection