@extends('backend.layouts.dashboard.master')

@section('title', 'Dashboard')



@section('css')

<link rel="stylesheet" type="text/css" href="{{asset('backend/css/vendors/animate.css')}}">
<meta name="_token" content="{{csrf_token()}}" />
@endsection



@section('style')

@endsection



@section('breadcrumb-title')

<h3>Profile</h3>

@endsection



@section('breadcrumb-items')

<li class="breadcrumb-item">Dashboard</li>

<li class="breadcrumb-item">Profile</li>

@endsection



@section('content')



<div class="container-fluid">

    <div class="card">

       <div class="card-header">

          <h5>User Details</h5>

          @if ($errors->any())

                <div class="alert alert-danger">

                    <ul>

                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

          @endif

       </div>

       <form action="{{route('admin.user.profile')}}" method="post">

        @csrf

       <div class="card-body">

            <div class="form-group form-row">
                    <label for="name" class="col-sm-5 col-form-label">Your Name:</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="name" value="{{ $user->name}}" name="name">
                    </div>
            </div>

            <div class="form-group form-row">
                    <label for="email" class="col-sm-5 col-form-label">Your email address:</label>
                    <div class="col-sm-7">
                        <input type="email" class="form-control" id="email" value="{{$user->email}}" readonly name="email" require="" >
                    </div>
            </div>
            
            <div class="form-group form-row">
                    <label for="phone" class="col-sm-5 col-form-label">Your phone number:</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="phone" value="{{ $user->phone}}" name="phone">
                    </div>
            </div>
            
            <div class="form-group form-row">
                    <label for="role" class="col-sm-5 col-form-label">Your position/role:</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="role" value="{{ ($user->companies) ? $user->companies->role : ''}}" name="role">
                    </div>
            </div>
            
            <div class="form-group form-row">
                    <label for="business_name" class="col-sm-5 col-form-label">Name of business:</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="business_name" value="{{ ($user->companies) ? $user->companies->business_name : '' }}" name="business_name">
                    </div>
            </div>
            
            <div class="form-group form-row">
                    <label for="address" class="col-sm-5 col-form-label">Address:</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="address" value="{{ ($user->companies) ? $user->companies->user_address : '' }}" name="address">
                    </div>
            </div>
            
            <div class="form-group form-row">
                    <label for="city" class="col-sm-5 col-form-label">City:</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="city" value="{{ ($user->companies) ? $user->companies->city : '' }}" name="city">
                    </div>
            </div>
            
            <div class="form-group form-row">
                    <label for="state" class="col-sm-5 col-form-label">State/province:</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="state" value="{{ ($user->companies) ? $user->companies->state : '' }}" name="state">
                    </div>
            </div>
            <div class="form-group form-row">
                    <label for="country" class="col-sm-5 col-form-label">Country:</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="country" value="{{($user->companies) ? $user->companies->country : ''}}" name="country">
                    </div>
            </div>

            <div class="form-group form-row">
                    <label for="no_of_employee" class="col-sm-5 col-form-label">No of Employees:</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="no_of_employee" value="{{ ($user->companies) ? $user->companies->no_of_employee : ''}}" name="no_of_employee">
                    </div>
            </div>
            
            <div class="form-group form-row">
                    <label for="purpose" class="col-sm-5 col-form-label">Purpose of calling:</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="purpose" value="{{ ($user->companies) ? $user->companies->purpose : '' }}" name="purpose">
                    </div>
            </div>
            
            <div class="form-group form-row">
                    <label for="company_name" class="col-sm-5 col-form-label">Exsisting Phone Company's Name:</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="company_name" value="{{ ($user->companies) ? $user->companies->company_name : '' }}" name="company_name">
                    </div>
            </div>
                    
            <div class="form-group form-row">
                    <label for="company_website" class="col-sm-5 col-form-label">Exsisting Phone Company's Website:</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="company_website" value="{{ ($user->companies) ? $user->companies->company_website : '' }}" name="company_website">
                    </div>
            </div>
                    
            <div class="form-group form-row">
                    <label for="office_phone" class="col-sm-5 col-form-label">Exsisting number of phone in your office:</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="office_phone" value="{{ ($user->companies) ? $user->companies->office_phone : '' }}" name="office_phone">
                    </div>
            </div>
                    
            <div class="form-group form-row">
                    <label for="own_phone" class="col-sm-5 col-form-label">Do you own the Phones or provided to you by the existing phone company:</label>
                    <div class="col-sm-7">
                        <select class="form-control" id="own_phone" name="own_phone" require>
                            <option value="owned" {{ ($user->companies && $user->companies->own_phone == 'owned') ? 'selected=""' : '' }} >owned</option>
                            <option value="leased" {{ ($user->companies && $user->companies->own_phone == 'leased') ? 'selected=""' : '' }} >leased</option>
                        </select>
                    </div>
            </div>
                    
            <div class="form-group form-row">
                    <label for="no_of_phone" class="col-sm-5 col-form-label">How many employees would need a phone:</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="no_of_phone" value="{{ ($user->companies) ? $user->companies->no_of_phone : '' }}" name="no_of_phone">
                    </div>
            </div>

                    
            <div class="form-group form-row">
                    <label for="emp_same_time" class="col-sm-5 col-form-label">How many employees are on the phone at the same time:</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="emp_same_time" value="{{($user->companies) ? $user->companies->emp_same_time : '' }}" name="emp_same_time">
                    </div>
            </div>

            <div class="form-group form-row">
                    <label for="new_phone" class="col-sm-5 col-form-label">Do you want a new phone number or would you keep exsisting number:</label>
                    <div class="col-sm-7">
                        <select class="form-control" id="new_phone" name="new_phone" require>
                        <option value="Require New Number" {{($user->companies && $user->companies->new_phone == "Require New Number") ? 'selected=""' : '' }}>Require New Number</option>
                        <option value="Keep Existing Number" {{($user->companies && $user->companies->new_phone == "Keep Existing Number") ? 'selected=""' : '' }}>Keep Existing Number</option>
                        </select>
                    </div>
            </div>
                    
            <div class="form-group form-row new_phone" <?php echo ($user->companies && $user->companies->new_phone == "Keep Existing Number") ? 'style="display:none;"' : '';?>>
                    <label for="new_phone" class="col-sm-5 col-form-label">Enter your desired area code and last 4 digits<a href="javascript:void(0);" data-toggle="tooltip" data-placement="bottom" title="Our technicians will try to find the number of your choice but we cannot guarantee aquire">?</a></label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" maxlength="3" id="new_area_code" value="{{($user->companies) ? $user->companies->new_area_code : '' }}" name="new_area_code" require placeholder="Area Code">
                    </div>
                    <div class="col-sm-2">
                        <span style="background:gray"></span>
                    </div>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="new_phone_last" value="{{($user->companies) ? $user->companies->new_phone_last : '' }}" maxlength="4" name="new_phone_last" require placeholder="Last 4 digits">
                    </div>
            </div>

            <div class="form-group form-row exsisting_phone" <?php echo ($user->companies && $user->companies->new_phone == "Require New Number") ? 'style="display:none;"' : '';?> >
                    <label for="exsisting_phone" class="col-sm-5 col-form-label">What is the exsisting phone number:</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="exsisting_phone" value="{{($user->companies) ? $user->companies->exsisting_phone : '' }}" name="exsisting_phone" require>
                    </div>
            </div>

       </div>

       <div class="card-footer">

        <button class="btn btn-secondary">Update</button>

    </div>

    </form>

    </div>

 </div>

@endsection



@section('script')

<script src="{{asset('backend/js/dashboard/default.js')}}"></script>
<script>
$('#new_phone').on('change',function(){
   if (this.value == "Require New Number") {
      $('.new_phone').show();
      $('.exsisting_phone').hide();
   } else {
      $('.new_phone').hide();
      $('.exsisting_phone').show();
   }
});
</script>
@endsection