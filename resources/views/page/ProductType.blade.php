@extends('master')
@section('content')
<div class="inner-header">
    <div class="container">
        <div class="pull-left">
            <h6 class="inner-title">Sản phẩm {{$type_pd->name}}</h6>
        </div>
        <div class="pull-right">
            <div class="beta-breadcrumb font-large">
                <a href="{{ route('index') }}">Trang chủ</a> / <span>Loại sản phẩm</span>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div class="container">
    <div id="content" class="space-top-none">
        <div class="main-content">
            <div class="space60">&nbsp;</div>
            <div class="row">
                <div class="col-sm-3">
                    <ul class="aside-menu">
                        @foreach($type_d as $ty)
                        <li><a href="{{ route('product_type',$ty->id) }}">{{ $ty->name }}</a></li>
                            @endforeach
                    </ul>
                </div>
                <div class="col-sm-9">
                    <div class="beta-products-list">
                        <h4>Sản phẩm mới</h4>
                        <div class="beta-products-details">
                            <p class="pull-left">Tìm thấy {{ count($product_Type) }} sản phẩm</p>
                            <div class="clearfix"></div>
                        </div>

                        <div class="row">
                            @foreach($product_Type as $pdt)
                            <div class="col-sm-4">
                                <div class="single-item">
                                    @if($pdt->promotion_price!=0)
                                        <div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
                                    @endif
                                    <div class="single-item-header">
                                        <a href="{{ route('product_detail',$pdt->id) }}"><img src="source/image/product/{{ $pdt->image }}" alt="" height="250px"></a>
                                    </div>
                                    <div class="single-item-body">
                                        <p class="single-item-title">{{ $pdt->name }}</p>
                                        <p class="single-item-price">
                                            @if($pdt->promotion_price!=0)
                                                <span class="flash-del">{{ number_format($pdt->unit_price) }} VND</span>
                                                <span class="flash-sale">{{ number_format($pdt->promotion_price) }} VND</span>
                                            @else
                                            <span class="flash-sale">{{ number_format($pdt->unit_price) }} VND</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="single-item-caption">
                                        <a class="add-to-cart pull-left" href="shopping_cart.html"><i class="fa fa-shopping-cart"></i></a>
                                        <a class="beta-btn primary" href="product.html">Details <i class="fa fa-chevron-right"></i></a>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="space40">&nbsp;</div>
                            </div>
                            @endforeach
                        </div>
                    </div> <!-- .beta-products-list -->
                    <div class="space40">&nbsp;</div>
                    <div class="space50">&nbsp;</div>

                    <div class="beta-products-list">
                        <h4>Sản phẩm khác</h4>
                        <div class="beta-products-details">
                            <p class="pull-left">Tìm thấy {{ count($product_different) }} sản phẩm </p>
                            <div class="clearfix"></div>
                        </div>
                        <div class="row">
                            @foreach($product_different as $pdd)
                                <div class="col-sm-4">
                                    <div class="single-item">
                                        @if($pdd->promotion_price!=0)
                                            <div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
                                        @endif
                                        <div class="single-item-header">
                                            <a href="{{ route('product_detail',$pdd->id) }}"><img src="source/image/product/{{ $pdd->image }}" alt="" height="250px"></a>
                                        </div>
                                        <div class="single-item-body">
                                            <p class="single-item-title">{{ $pdd->name }}</p>
                                            <p class="single-item-price">
                                                @if($pdd->promotion_price!=0)
                                                    <span class="flash-del">{{ number_format($pdd->unit_price) }} VND</span>
                                                    <span class="flash-sale">{{ number_format($pdd->promotion_price) }} VND</span>
                                                @else
                                                    <span class="flash-sale">{{ number_format($pdd->unit_price) }} VND</span>
                                                @endif
                                            </p>
                                        </div>
                                        <div class="single-item-caption">
                                            <a class="add-to-cart pull-left" href="shopping_cart.html"><i class="fa fa-shopping-cart"></i></a>
                                            <a class="beta-btn primary" href="product.html">Details <i class="fa fa-chevron-right"></i></a>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <div class="space40">&nbsp;</div>
                                </div>
                            @endforeach
                        </div>
                        <div class="space40">&nbsp;</div>
                        <div class="row">{{ $product_different->links() }}</div>

                    </div> <!-- .beta-products-list -->
                </div>
            </div> <!-- end section with sidebar and main content -->


        </div> <!-- .main-content -->
    </div> <!-- #content -->
</div> <!-- .container -->
@endsection
