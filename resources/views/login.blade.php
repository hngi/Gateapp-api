@extends('layout')

@section('content')
<div class="col-12 download-footer px-0">
<div class="col-12 download-app row mx-0">

    <div class="login col-md-5 offset-md-3">
        <h3>Login</h3>
        <form role="form">
            <div class="form-group">
                <input type="email" style="border: 1px solid #000;" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
            </div>
            <div class="form-group">
                <input type="password"  style="border: 1px solid #000;" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-success form-control">Submit</button>
        </form>
    </div>

</div>
@endsection