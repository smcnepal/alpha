@extends('template.layout')
@section('title','user login page')
@section('content')

<form action="{{url('login')}}" method="POST">
    @csrf
    <div class="container">
        <h4>Registration form</h4>
        <div class="row">
            
            <div class="col-md-6">
                <label for="">Email</label>
                <input type="email" class="form-control" name="email" placeholder="Enter name">
            </div>
            <div class="col-md-6">
                <label for="">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Enter name">
            </div>
        </div>
        <div class="">
            <input type="submit" class="btn btn-primary w-50" style="margin-top:31px" value="login">
        </div>
    </div>
</form>
@endsection

@section('custom-script')
    
@endsection