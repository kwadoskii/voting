@extends('layouts.master')

@section('title')
    Welcome
@endsection
@section('section')
    <div class="showcase">
        <div class="container-fluid container">
            <div class="row no-gutters">
                <div class="col-lg-6 showcase-img text-white" id="vimg"></div>

                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-sm-10">
                            <h5>Welcome please login to your account to proceed.</h5>
                            <form action="">
                                <div class="form-group">
                                    <label for="vin">VIN</label>
                                    <input type="text" class="form-control" placeholder="1234567890" name="vin">
                                </div>

                                <div class="form-group">
                                    <label for="vin">Password</label>
                                    <input type="password" class="form-control" placeholder="1234567890" name="vin">
                                </div>
                                <input type="hidden" value="{{ Session::token() }}" name="_token">
                                <button type="submit" class="btn btn-info">Sign in</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
