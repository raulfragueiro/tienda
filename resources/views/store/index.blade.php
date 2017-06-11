@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Camisetas</h3>
        </div>
        <div class="row" id="products">
            @foreach($cat1 as $product)
                <div class="col-md-4 white-panel Mjgb">
                    <div class="panel panel-default">
                        <div class="panel-heading">{{ $product -> name }}</div>
                            <div class="panel-body">
                                <img src="{{$product->image}}" style="height: 18em">
                            </div>
                        <div class="panel-body texto mj">
                            {{$product->extract}}
                        </div>
                        <div class="panel-body" style="font-weight:bold; text-align: right">
                            {{$product->price}}€<hr>
                            <a href="{{ route('cart-add', $product->slug) }}" class="btn btn-danger"><i class="fa fa-cart-plus"></i> Añadir al carrito</a>
                            <a href="{{route('product-detail' , $product->slug)}}" class="btn btn-primary"><i class="fa fa-chevron-circle-right"></i>  Leer más</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
                <div class="row">
                    <h3>Figuras</h3>
                </div>
        <div class="row" id="products">
            @foreach($cat2 as $product)
                <div class="col-md-4 white-panel Mjgb">
                    <div class="panel panel-default">
                        <div class="panel-heading">{{ $product -> name }}</div>
                        <div class="panel-body">
                            <img src="{{$product->image}}" style="height: 21em">
                        </div>
                        <div class="panel-body texto mj">
                            {{$product->extract}}
                        </div>
                        <div class="panel-body" style="font-weight:bold; text-align: right">
                            {{$product->price}}€<hr>
                            <a href="{{ route('cart-add', $product->slug) }}" class="btn btn-danger"><i class="fa fa-cart-plus"></i> Añadir al carrito</a>
                            <a href="{{route('product-detail' , $product->slug)}}" class="btn btn-primary"><i class="fa fa-chevron-circle-right"></i>  Leer más</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
