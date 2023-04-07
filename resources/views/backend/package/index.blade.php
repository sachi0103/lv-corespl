@extends('backend.layouts.dashboard.master')

@section('title', 'Users')

@section('css')

<link rel="stylesheet" type="text/css" href="{{asset('backend/css/vendors/animate.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('backend/css/vendors/datatables.css')}}">

@endsection

@section('style')

@endsection



@section('breadcrumb-title')

<h3>Manage Package</h3>

@endsection

@section('breadcrumb-items')

<li class="breadcrumb-item">Manage Package</li>

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
                            
                            <div class="col-sm-8"><h5>Package Information</h5></div>

                            <div class="col-sm-4">
                                <div class="pull-right"> 
                                    <a href="{{route('admin.packages.create')}}" class="btn btn-primary">Create New</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-striped" id="account-table">

                            <thead>

                                <tr>

                                    <th scope="col">#</th>

                                    <th scope="col">Name</th>

                                    <th scope="col">Purchase Date</th>

                                    <th scope="col">No Of Package</th>

                                    <th scope="col">No Of Used Package</th>

                                    <th scope="col">Price/<small>per</small></th>

                                    <th scope="col">Total</th>

                                </tr>

                            </thead>

                            <tbody>
                                @forelse ($packages as $key => $package)
                                    <tr>
                                        <th scope="row">{{ $key+1 }}</th>

                                        <td>{{$package->package_name}}</td>

                                        <td>{{ date('Y-m-d',strtotime($package->created_at)) }}</td>

                                        <td>{{$package->number_of_packages}}</td>

                                        <td>{{$package->use_packaged}}</td>

                                        <td>{{$package->charge_per_package}}</td>

                                        <td>{{$package->total}}</td>
                                    </tr>
                                    @empty
                                    <tr align="center"><td colspan="6">No data found </td></tr>
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