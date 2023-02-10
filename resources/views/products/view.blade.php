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
                           
                        </div>
                    </div>

                </div>
                <div class="card-body px-0">

                    <div class="col-12">
                        <div class="row">
                            <div class="col-12">
                                <b>Código: </b> {{ $data->code }} <br>
                                
                                @if(isset($data->description))
                                    <b>{{ ($data->description->title!='') ? $data->description->title:$data->name }}: </b><br>
                                    {{ $data->description->description }} <br>
                                @endif

                                
                            </div>
                            <div class="col-12 col-lg-4">
                                <img src="{{ asset("images/products/$data->image") }}" alt="image gallery" id="imageGallery" class="img-fluid">
                            </div>
                            
                            <div class="col-12 col-lg-8">
                                <div class="row">
                                    <div class="col-3">
                                        <a href="javascript:showImage('{{ asset("images/products/$data->image") }}')">
                                            <img src="{{ asset("images/products/$data->image") }}" class="img-fluid gallery" alt="default" >
                                        </a>
                                    </div>
                                    @foreach ($data->gallery as $image)
                                        <div class="col-3">
                                            <a href="javascript:showImage('{{ asset("images/products/$image->image") }}')">
                                                <img src="{{ asset("images/products/$image->image") }}" class="img-fluid img-thumbnail gallery" alt="{{ $image->image }}">
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div> 
                            
                            <div class="col-12 ">
                                <div class="row">
                                    <div class="col-12 col-lg-4">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th colspan="2" class="text-center">Precios</th>
                                                </tr>
                                            </thead>
                                            <tr>
                                                <td><b>Precio Menudeo</b></td>
                                                <td>$ {{ number_format($data->price1,2,'.',',') }}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Precio Mayoreo</b></td>
                                                <td>$ {{ number_format($data->price2,2,'.',',') }}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Precio Distribuidor</b></td>
                                                <td>$ {{ number_format($data->price3,2,'.',',') }}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Precio Caja</b></td>
                                                <td>$ {{ number_format($data->price4,2,'.',',') }}</td>
                                            </tr>
                                        </table>                                        
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Contenido</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data->content as $content)
                                                    <tr>
                                                        <td>
                                                            {{ $content->title }} {{ $content->description }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                    <div class="col-12">
                                        @foreach ($data->specifications as $specification)

                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>{{ $specification->title }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $l=0; 
                                                        $sub = $specification->subs;
                                                    @endphp
                                                    @for($i=1;$i<count($sub);)
                                                        <tr>
                                                            <td>
                                                                {{$sub[$l]->description}}
                                                                {{$sub[$i]->description}}
                                                            </td>
                                                        </tr>
                                                        @php $i+=2 @endphp
                                                        @php $l = $i-1 @endphp
                                                    @endfor
                                                </tbody>
                                            </table>
                                            
                                        @endforeach
                                        
                                        
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>                   

                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        const imageGallery = document.getElementById('imageGallery');
        function showImage(target){            
            imageGallery.src = target;
        }
    </script>        
@endsection
