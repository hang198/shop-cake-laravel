@extends('master')
@section('content')
    <div class="inner-header">
        <div class="container">
            <div class="pull-left">
                <h6 class="inner-title">Đăng kí</h6>
            </div>
            <div class="pull-right">
                <div class="beta-breadcrumb">
                    <a href="{{ route('index') }}">Home</a> / <span>Đăng kí</span>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="container">
        <div id="content">

            <form action="{{ route('postSignup') }}" method="post" class="beta-form-checkout">
                @csrf
                <div class="row">
                    <div class="col-sm-3"></div>
                    @if(Session::has('thanhcong'))
                        <div class="alert alert-success">{{Session::get('thanhcong')}}</div>
                        @endif
                    <div class="col-sm-6">
                        <h4>Đăng kí</h4>
                        <div class="space20">&nbsp;</div>


                        <div class="form-block">
                            <label for="email">Email address*</label>
                            <input type="email" value="{{ old('email') }}" name="email">
                        </div>
                        @if($errors->has('email'))
                            <div class="alert alert-danger">
                                {{$errors->first('email')}}
                            </div>
                        @endif

                        <div class="form-block">
                            <label for="your_last_name">Fullname*</label>
                            <input type="text" value="{{ old('full_name') }}" id="your_last_name" name="full_name">
                        </div>
                        @if($errors->has('full_name'))
                            <div class="alert alert-danger">
                                {{$errors->first('full_name')}}
                            </div>
                        @endif

                        <div class="form-block">
                            <label for="adress">Address*</label>
                            <input type="text" value="{{ old('address') }}" id="adress" name="address" >
                        </div>
                        @if($errors->has('address'))
                            <div class="alert alert-danger">
                                {{$errors->first('address')}}
                            </div>
                        @endif


                        <div class="form-block">
                            <label for="phone">Phone*</label>
                            <input type="text" value="{{ old('phone') }}"id="phone" name="phone">
                        </div>
                        @if($errors->has('phone'))
                            <div class="alert alert-danger">
                                {{$errors->first('phone')}}
                            </div>
                        @endif
                        <div class="form-block">
                            <label for="phone">Password*</label>
                            <input type="password" value="{{ old('password') }}"id="phone" name="password">
                        </div>
                        @if($errors->has('password'))
                            <div class="alert alert-danger">
                                {{$errors->first('password')}}
                            </div>
                        @endif
                        <div class="form-block">
                            <label for="phone">Re password*</label>
                            <input type="password" value="{{ old('re_password') }}"id="phone" name="re_password">
                        </div>
                        @if($errors->has('re_password'))
                            <div class="alert alert-danger">
                                {{$errors->first('re_password')}}
                            </div>
                        @endif
                        <div class="form-block">
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                    </div>
                    <div class="col-sm-3"></div>
                </div>
            </form>
        </div> <!-- #content -->
    </div> <!-- .container -->
@endsection
