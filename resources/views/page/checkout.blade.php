@extends('master')
@section('content')
    <div class="container">
        <div id="content">
            <form action="{{route('postCheckOut')}}" method="post" class="beta-form-checkout">
                @csrf
                @if(Session::has('thongbao'))
                    <div class="alert alert-success">{{Session::get('thongbao')}}</div>
                @endif
                <div class="row">
                    <div class="col-sm-6">
                        <h4>Đặt hàng</h4>
                        <div class="space20">&nbsp;</div>
                        <div class="form-block">
                            <label for="name">Họ tên*</label>
                            <input type="text" id="name" name="name" placeholder="Họ tên" >
                        </div>
                        @if($errors->has('name'))
                        <div class="alert alert-danger">
                                {{$errors->first('name')}}
                        </div>
                        @endif
                        <div class="form-block">
                            <label>Giới tính </label>
                            <input id="gender" type="radio" class="input-radio" name="gender" value="nam"
                                   checked="checked" style="width: 10%"><span style="margin-right: 10%">Nam</span>
                            <input id="gender" type="radio" class="input-radio" name="gender" value="nữ"
                                   style="width: 10%"><span>Nữ</span>

                        </div>

                        <div class="form-block">
                            <label for="email">Email*</label>
                            <input type="email" id="email" name="email"  placeholder="expample@gmail.com">
                        </div>
                        @if($errors->has('email'))
                        <div class="alert alert-danger">
                                {{$errors->first('email')}}
                        </div>
                        @endif

                        <div class="form-block">
                            <label for="address">Địa chỉ*</label>
                            <input type="text" id="address" name="address" placeholder="Street Address" >
                        </div>
                        @if($errors->has('address'))
                            <div class="alert alert-danger">
                                {{$errors->first('address')}}
                            </div>
                        @endif


                        <div class="form-block">
                            <label for="phone">Điện thoại*</label>
                            <input type="text" id="phone" name="phone" >
                        </div>
                        @if($errors->has('phone'))
                        <div class="alert alert-danger">
                                {{$errors->first('phone')}}
                        </div>
                        @endif

                        <div class="form-block">
                            <label for="notes">Ghi chú</label>
                            <textarea id="notes" name="note"></textarea>
                        </div>
                        @if($errors->has('note'))
                        <div class="alert alert-danger">
                                {{$errors->first('note')}}
                        </div>
                        @endif
                    </div>
                    <div class="col-sm-6">
                        <div class="your-order">
                            <div class="your-order-head"><h5>Đơn hàng của bạn</h5></div>
                            <div class="your-order-body" style="padding: 0px 10px">
                                <div class="your-order-item">
                                    <div>
                                    @if(Session::has('cart'))
                                        @foreach($cart->items as $product)
                                            <!--  one item	 -->
                                                <div class="media">
                                                    <img
                                                         src="source/image/product/{{$product['item']['image']}}"
                                                         alt="" width="50px" height="50px"
                                                         class="pull-left">
                                                    <div class="media-body">
                                                        <p class="font-large">{{$product['item']['name']}}</p>
                                                        <span
                                                            class="color-gray your-order-info">Số Lượng: {{$product['qty']}}</span>
                                                        <span
                                                            class="color-gray your-order-info">Tổng tiền chưa giảm giá: {{number_format($product['price'])}} đồng</span>
                                                    </div>
                                                </div>
                                                <!-- end one item -->
                                    </div>
                                    @endforeach
                                    @else
                                        {{'Không có sản phẩm nào'}}
                                    @endif
                                    <div class="clearfix"></div>
                                </div>
                                <div class="your-order-item">
                                    <div class="pull-left"><p class="your-order-f18">Tổng tiền thanh toán:</p></div>
                                    <div class="pull-right"><h5
                                            class="color-black">@if(Session::has('cart')){{number_format(Session::get('cart')->totalPrice)." VND"}}
                                            @else {{'0'}}
                                            @endif</h5></div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="your-order-head"><h5>Hình thức thanh toán</h5></div>

                            <div class="your-order-body">
                                <ul class="payment_methods methods">
                                    <li class="payment_method_bacs">
                                        <input id="payment_method_bacs" type="radio" class="input-radio"
                                               name="payment" value="COD" checked="checked"
                                               data-order_button_text="">
                                        <label for="payment_method_bacs">Thanh toán khi nhận hàng </label>
                                        <div class="payment_box payment_method_bacs" style="display: block;">
                                            Cửa hàng sẽ gửi hàng đến địa chỉ của bạn, bạn xem hàng rồi thanh toán tiền
                                            cho nhân viên giao hàng
                                        </div>
                                    </li>

                                    <li class="payment_method_cheque">
                                        <input id="payment_method_cheque" type="radio" class="input-radio"
                                               name="payment" value="ATM" data-order_button_text="">
                                        <label for="payment_method_cheque">Chuyển khoản </label>
                                        <div class="payment_box payment_method_cheque" style="display: none;">
                                            Chuyển tiền đến tài khoản sau:
                                            <br>- Số tài khoản: 123 456 789
                                            <br>- Chủ TK: Nguyễn A
                                            <br>- Ngân hàng ACB, Chi nhánh TPHCM
                                        </div>
                                    </li>

                                </ul>
                            </div>

                            <div class="text-center">
                                <button class="beta-btn primary" href="{{route('postCheckOut')}}" type="submit">Đặt
                                    hàng <i
                                        class="fa fa-chevron-right"></i></button>
                            </div>
                        </div> <!-- .your-order -->
                    </div>
                </div>
            </form>
        </div> <!-- #content -->
    </div> <!-- .container -->
@endsection
