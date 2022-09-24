@extends('backend.layouts.dashboard.master')

@section('title', 'Dashboard')



@section('css')

<link rel="stylesheet" type="text/css" href="{{asset('backend/css/vendors/animate.css')}}">

@endsection



@section('style')

@endsection



@section('breadcrumb-title')

<h3>View Accounts</h3>

@endsection



@section('breadcrumb-items')

<li class="breadcrumb-item">Manage Accounts</li>

<li class="breadcrumb-item">View Accounts</li>

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

                            <h5>Accounts Information</h5>

                        </div>

                        <div class="table-responsive">

                            <table class="table">

                                <thead>

                                    <tr>

                                        <th scope="col">#</th>

                                        <th scope="col">User Name</th>

                                        <th scope="col">User Email</th>

                                        <th scope="col">Ammount</th>

                                        <th scope="col">Allowed Minutes</th>

                                        <th scope="col">Remaining Minutes</th>

                                        <th scope="col">Purchase Date</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    @forelse ($accounts as $key => $account)

                                    <tr>

                                        <th scope="row">{{ $key+1 }}</th>

                                        <td>{{$account->name}}</td>

                                        <td>{{$account->email}}</td>

                                        <td>{{$account->amount}}</td>

                                        <td>{{$account->allowed_minutes}}</td>

                                        <td>{{$account->remaining_minutes}}</td>

                                        <td>{{$account->purchase_date}}</td>

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

