@extends('backend.layouts.dashboard.master')

@section('title', 'Users')

@section('css')

<link rel="stylesheet" type="text/css" href="{{asset('backend/css/vendors/animate.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('backend/css/vendors/datatables.css')}}">
<meta name="_token" content="{{csrf_token()}}" />

@endsection

@section('style')

@endsection



@section('breadcrumb-title')

<h3>Manage Users</h3>

@endsection

@section('breadcrumb-items')

<li class="breadcrumb-item">Manage Users</li>

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
                            
                            <div class="col-sm-8"><h5>User Information</h5></div>

                            <div class="col-sm-4">
                                <div class="pull-right"> 
                                    <a href="{{route('admin.users.create')}}" class="btn btn-primary">Create New</a>
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

                                    <th scope="col">Email</th>

                                    <th scope="col">Phone</th>

                                    <th scope="col">Address</th>

                                    <th scope="col">Action</th>

                                </tr>

                            </thead>

                            <tbody>
                                @forelse ($users as $key => $account)
                                    <tr>
                                        <th scope="row">{{ $key+1 }}</th>

                                        <td>{{$account->name}}</td>

                                        <td>{{$account->email}}</td>

                                        <td>{{$account->phone}}</td>

                                        <td>{{$account->user_address}}</td>

                                        <td>
                                            <a href="{{route('admin.users.edit',md5($account->id))}}" class="text-info"><i class="fa fa-edit"></i></a>
                                            <?php if ($account->package_id == 0) { ?>
                                                <a href="javascript:void(0);" onclick="deleteCustomer('{{md5($account->id)}}');" class="text-danger"><i class="fa fa-trash"></i></a>
                                            <?php } else { ?>
                                                <a href="javascript:void(0);" onclick="reassignModel({{$account->id}});" class="text-info"><i class="fa fa-sign-in"></i></a>
                                            <?php } ?>
                                        </td>
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

<!-- Modal -->
<div class="modal fade" id="reassign_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">User reassign package</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form action="{{route('admin.users.reassignPackage')}}" method="post" id="myform">
        @csrf  
            <div class="modal-body">
                <input type="hidden" name="user_id" id="user_id" />
                <div class="form-group row">
                    <div class="col-md-12">
                        <label class='col-form-label'>Select New User</label>
                        <select id="new_user_id" name="new_user_id" class="form-control">
                            <option>Select User</option>
                            @foreach ($users as $key => $account)
                                @if ($account->package_id == 0)
                                    <option value="{{$account->id}}">{{$account->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
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

  function reassignModel(user_id) {
    $('#user_id').val(user_id);
    $('#reassign_model').modal('show');
  }

  function deleteCustomer(custId) {
    let text = "Are you sure you want to remove customer";
    if (confirm(text) == true) {
        window.location.assign(window.location.origin+"/call-recall/users/removed/"+custId);
    }
 }
</script>

@endsection