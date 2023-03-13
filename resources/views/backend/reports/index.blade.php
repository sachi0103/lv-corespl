@extends('backend.layouts.dashboard.master')
@section('title', 'Reports')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('backend/css/vendors/animate.css')}}">
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
                            <h5>Call Log Reports </h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
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
                                        <h4>No Record Found</h4>
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
        </div>
@endsection
@section('script')
<script src="{{asset('backend/js/dashboard/default.js')}}"></script>
@endsection
