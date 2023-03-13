@extends('backend.layouts.dashboard.master')

@section('title', 'Dashboard')



@section('css')

<link rel="stylesheet" type="text/css" href="{{asset('backend/css/vendors/animate.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('backend/css/vendors/datatables.css')}}">

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

                            <div class="row">
                                
                                <div class="col-sm-8"><h5>Accounts Information</h5></div>

                                <div class="col-sm-4">
                                    <div class="pull-right"> 
                                        <a href="{{ route('admin.accounts.renew_all_plan' , base64_encode(auth()->user()->id)) }}" class="btn btn-info">Renew All</a>
                                        <a href="{{route('admin.accounts.create')}}" class="btn btn-primary">Create New</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">

                            <table class="table table-striped" id="account-table">

                                <thead>

                                    <tr>

                                        <th scope="col">#</th>

                                        <th scope="col">User Name</th>

                                        <th scope="col">User Email</th>

                                        <th scope="col">Purchase Date</th>

                                        <th scope="col">Plan Purchased</th>

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

                                        <td>{{date('Y-m-d',strtotime($account->created_at))}}</td>

                                        <td>{{$account->package_name}}</td>

                                        <td>{{$account->remaining_minutes}}</td>

                                        <td> {{ ( $account->expire_date ) ? date("Y-m-d",strtotime($account->expire_date) ) : '' }}</td>

                                        <td> 
                                            
                                            <a href="{{ route('admin.accounts.renew_plan', base64_encode($account->customer_packages_id)) }}" class="btn-sm btn-info">Renew</a>

                                            <?php 
                                            $allowedMinutes = ($account->allowed_minutes * ($changePlanLimit/100));
                                            if($account->remaining_minutes <= $allowedMinutes ) { ?>    
                                                <a href="{{ route('admin.accounts.add_minutes', base64_encode($account->customer_id)) }}" class="btn-sm btn-info">Change Plan</a> 
                                            <?php } ?>
                                        </td>

                                    </tr>

                                    @empty
                                    <tr><td colspan="8">No data found </td></tr>
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
<script src="{{asset('backend/js/datatable/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript">
  $(function () {
    var table = $('#account-table').DataTable();
  });
</script>
@endsection

