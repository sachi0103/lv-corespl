@extends('backend.layouts.dashboard.master')

@section('title', 'Users')

@section('css')

<link rel="stylesheet" type="text/css" href="{{asset('backend/css/vendors/animate.css')}}">
<meta name="_token" content="{{csrf_token()}}" />

@endsection

@section('style')

@endsection



@section('breadcrumb-title')

<h3>Update user details</h3>

@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{route('admin.users.index')}}">Manage Users</a></li>
<li class="breadcrumb-item">Update user details</li>

@endsection

@section('content')

    @if ($errors->any())

        <div class="alert alert-danger">

            <ul>

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <div class="container-fluid">

        <div class="row">

            <div class="col-sm-12">
                
                <form action="{{route('admin.users.update')}}" method="post" id="myform">
                @csrf
                    <input type="hidden" name="id" value="{{md5($user->id)}}" />
                    <div class="card">

                        <div class="card-header">

                            <div class="row">
                                
                                <div class="col-sm-8"><h5>Update user details</h5></div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label class='col-form-label'>User Name</label>
                                    <input class='form-control' id='name' value="{{$user->name}}" type='text' name='name' placeholder='Enter name' required>
                                </div>
                                <div class="col-md-4">
                                    <label class='col-form-label'>Email Address</label>
                                    <input class='form-control' id='email' value="{{$user->email}}" type='text' name='email' placeholder='Enter email address' required readonly="">
                                </div>
                                <div class="col-md-4">
                                    <label class='col-form-label'>User Phone</label>
                                    <input class='form-control' id='phone' value="{{$user->phone}}" type='text' name='phone' placeholder='Enter phone number'>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class='col-form-label'>User Name</label>
                                    <textarea class='form-control' placeholder='Enter address' id='user_address' name='user_address'>{{$user->user_address}}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button class="btn btn-secondary" type="submit">Update</button>
                        </div>
                    </div>
                
                </form>

            </div>

        </div>
    </div>
@endsection

@section('script')
@endsection