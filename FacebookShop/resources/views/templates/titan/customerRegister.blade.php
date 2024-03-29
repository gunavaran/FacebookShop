@extends('templates.titan.layout.layout')
@section('content')
    <section class="module">
        <div class="container">
            <div class="row">
                <div  style="margin-left: 20%;margin-right: 20%; width: 60% ">
                    <h4 class="font-alt" style="text-align: center; font-size: xx-large; color: #1C92C9"><b>Register</b></h4>
                    <hr class="divider-w mb-10">
                    <?php
                    use Illuminate\Support\Facades\Session;
                    $shopId = Session::get('siteShopId');
                        ?>
                    <form class="form" action="{{route('registerCustomer')}}">
                        {{csrf_field()}}
                        @if(count($errors) > 0)
                            @foreach($errors->all() as $error)
                                <p class="alert alert-danger"> {{$error}}</p>
                            @endforeach
                        @endif

                        <div class="form-group">
                            <input style="text-transform: none;font-size: large" class="form-control" id="first_name" type="text" name="first_name" placeholder="First Name" required/>
                        </div>
                        <div class="form-group">
                            <input style="text-transform: none;font-size: large" class="form-control" id="last_name" type="text" name="last_name" placeholder="Last Name" required/>
                        </div>
                        <div class="form-group">
                            <input style="text-transform: none;font-size: large" class="form-control" id="email" type="text" name="email" placeholder="Email" required/>
                        </div>
                        <div class="form-group">
                            <input style="text-transform: none;font-size: large" class="form-control" id="password" type="password" name="password" placeholder="Password" required/>
                        </div>
                        <div class="form-group">
                            <input style="text-transform: none;font-size: large" class="form-control" id="password_confirmation" type="password" name="password_confirmation" placeholder="Re-enter Password" required/>
                        </div>
                        <div class="form-group">
                            <input style="text-transform: none;font-size: large" class="form-control" id="shop_id" type="hidden" name="shop_id" value="{{$shopId}} "/>
                        </div>

                        <div class="form-group">
                            <button style="font-size: medium" class="btn btn-round btn-primary" type="submit">Register</button>
                            <button class="btn btn-round btn-b" style="font-size: medium" type="button"><a href="{{route('customerLogInPage')}}" style="color: white;">Log In</a></button>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
@endsection