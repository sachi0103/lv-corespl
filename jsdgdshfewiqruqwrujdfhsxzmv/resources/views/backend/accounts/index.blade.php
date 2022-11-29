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

                                        <th scope="col">Purchase Date</th>

                                        <td scope="col">Plan Purchased</td>

                                        <th scope="col">Remaining Minutes</th>

                                        <th scope="col">Expiry Date</th>

                                        <th scope="col">Action</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    @forelse ($accounts as $key => $account)

                                    <tr>

                                        <th scope="row">{{ $key+1 }}</th>

                                        <td>{{$account->name}}</td>

                                        <td>{{$account->email}}</td>

                                        <td>{{$account->purchase_date}}</td>

                                        <td>{{$account->package_name}}</td>

                                        <td>{{$account->remaining_minutes}}</td>

                                        <td> {{ ( in_array($account->package_id,[7,8]) ) ? date("Y-m-d",strtotime("+1 month", strtotime($account->purchase_date) ) ) : '' }}</td>

                                        <td> 
                                            
                                            <a href="{{ route('admin.accounts.renew_plan', base64_encode($account->customer_packages_id)) }}" class="btn-sm btn-info">Renew</a>

                                            <?php if($account->remaining_minutes <= $changePlanLimit ) { ?>    
                                                <a href="{{ route('admin.accounts.add_minutes', base64_encode($account->customer_id)) }}" class="btn-sm btn-info">Change Plan</a> 
                                            <?php } ?>
                                        </td>

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

