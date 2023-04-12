@extends('backend.layouts.dashboard.master')

@section('title', 'Reports')



@section('css')

<link rel="stylesheet" type="text/css" href="{{asset('backend/css/vendors/animate.css')}}">
<meta name="_token" content="{{csrf_token()}}" />
<link rel="stylesheet" type="text/css" href="{{asset('backend/css/vendors/datatables.css')}}">

@endsection



@section('style')

@endsection



@section('breadcrumb-title')

<h3>View Reports</h3>

@endsection



@section('breadcrumb-items')

<li class="breadcrumb-item">Manage Reports</li>

<li class="breadcrumb-item">View Reports</li>

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

                            <h5>Report Filter's</h5><br/>
                            <form action="{{route('admin.reports.index')}}" method="post" id="myform">
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label class='col-form-label'>Select New User</label>
                                    <select id="user_id" name="user_id" class="form-control">
                                        <option value="">Select User</option>
                                        @foreach ($users as $key => $account)
                                            <option value="{{$account['id']}}" <?php echo (isset($filterData['user_id']) && $filterData['user_id'] == $account['id']) ? 'selected=""' : '';?> >{{$account['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class='col-form-label'>Select New User</label>
                                    <input type="date" name="filter_date" value="{{ (isset($filterData['filter_date']) && !empty($filterData['filter_date'])) ? $filterData['filter_date'] : '' }}" class="form-control" />
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary" style="margin-top: 10%;">Search</button>
                                </div>
                            </div>
                            </form>
                        </div>

                        <div class="card-body">

                            <table class="display" id="advance-1">

                            <thead>

                                <tr>

                                <th>Number</th>

                                <th>Date</th>

                                <th>Time</th>

                                <th>Duration</th>

                                </tr>

                            </thead>

                            <tbody>

                                @forelse ($callLogs as $callLog)

                                <tr>

                                    <td>{{ $callLog->number }}</td>

                                    <td>{{ $callLog->date }}</td>

                                    <td>{{ $callLog->time }}</td>

                                    <td>{{ $callLog->duration }}</td>

                                </tr>

                                @empty
                                    <tr>
                                        <td>No Record Found</td>
                                    </tr>

                                @endforelse



                            </tbody>

                            <tfoot>

                            </tfoot>

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

