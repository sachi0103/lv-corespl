@extends('backend.layouts.dashboard.master')
@section('title', 'Dashboard')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('backend/css/vendors/animate.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>View Users</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Manage Users</li>
<li class="breadcrumb-item">View Users</li>
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
                    <div class="card">
                        <div class="card-header">
                            <h5>Users Information</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        {{-- <th scope="col">Package</th> --}}
                                        <th scope="col">Given Id</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Will Share</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($packageUsers as $key => $packageUser)
                                    <tr>
                                        <th scope="row">{{ $key+1 }}</th>
                                        {{-- <td>{{$packageUser->package->package_name}}</td> --}}
                                        <td>{{$packageUser->package_user_id}}</td>
                                        <td>{{$packageUser->name}}</td>
                                        <td>{{$packageUser->email}}</td>
                                        <td>{{$packageUser->willshare == 1 ? 'true' : 'false' }}</td>
                                    </tr>
                                    @empty
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('script')
<script src="{{asset('backend/js/dashboard/default.js')}}"></script>
@endsection
