@extends('backend.layouts.dashboard.master')
@section('title', 'Dashboard')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('backend/css/vendors/animate.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>View Payments</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Manage Payments</li>
<li class="breadcrumb-item">View Payments</li>
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
                            <h5>Payments Information</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        {{-- <th scope="col">Package</th> --}}
                                        <th scope="col">Number of Packages</th>
                                        <th scope="col">Number of User</th>
                                        <th scope="col">Charge per user</th>
                                        <th scope="col">Charge per Package</th>
                                        <th scope="col">Subtotal</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($payments as $key => $payment)
                                    <tr>
                                        <th scope="row">{{ $key+1 }}</th>
                                        {{-- <td>{{$payment->package->package_name}}</td> --}}
                                        <td>{{$payment->number_of_packages}}</td>
                                        <td>{{$payment->number_of_users}}</td>
                                        <td>$ {{$payment->charge_per_user}}</td>
                                        <td>$ {{$payment->charge_per_package}}</td>
                                        <td>$ {{$payment->subtotal}}</td>
                                        <td>$ {{$payment->total}}</td>
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
