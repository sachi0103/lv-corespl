@extends('backend.layouts.dashboard.master')
@section('title', 'Dashboard')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('backend/css/vendors/animate.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Manage Accounts</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Manage Accounts</li>
<li class="breadcrumb-item">Add Account</li>
@endsection

@section('content')

<div class="container-fluid">
    <div class="card">
       <div class="card-header">
          <h5>Billing Details</h5>
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
       <form action="{{route('admin.accounts.store')}}" method="post">
        @csrf
       <div class="card-body">
          <div class="row">
             <div class="col-lg-7 col-sm-12">
                 <h6>Account Information</h6>
                   <div class="row">
                    <div class="form-group col-md-12">
                        <label for="exampleFormControlSelect9">Which country will you be calling?</label>
                        <select class="form-control digits" name="country_id" id="exampleFormControlSelect9">
                            @forelse ($countries as $country)
                            <option value="{{$country->ID}}">{{$country->Name}}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                   </div>
                   <hr class="mt-4 mb-4">
                   <h6 class="mb-2">Packages</h6>
                   <div class="form-group mb-0 row">
                        <div class="col-md-12">
                            <div class="height-equal">
                                <div class="row">
                                    @forelse ($packages as $key => $package )
                                    <div class="col-sm-6">
                                        <div class="card">
                                            <div class="media p-20">
                                                <div class="radio radio-primary mr-3">
                                                    <input id="radio23{{$key}}" class="package-radio" type="radio" name="package_id" value="{{$package->package_id}}" data-price="{{$package->price}}">
                                                    <label for="radio23{{$key}}"></label>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="mt-0 mega-title-badge">{{$package->package_name}}
                                                        <br>  <span class="badge badge-secondary pull-right digits mt-1" style="float: left;">USD {{$package->price}} </span>
                                                    </h6>
                                                    <br>
                                                    <p class="mt-1">Package Type: {{$package->package_type}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
             </div>
             <div class="col-lg-5 col-sm-12">
                <div class="checkout-details" style="background-color: #f9f9f9; border: 1px solid #dddddd; padding: 40px;">
                   <div class="order-box">
                      <ul class="qty">
                         <li>Package Cost:<span class="package-cost">$0</span></li>
                         <li>User Cost:<span class="user-cost">$0</span></li>
                      </ul>
                      <ul class="qty">
                         <li>Subtotal: <span class="subtotal">$0</span></li>
                         <li>Taxes: <span class="taxes">$0</span></li>
                         <li>Delivery: <span class="dilevery">$0</span></li>

                      </ul>
                      <ul class="sub-total total">
                         <li>Total <span id="total-cost" class="count">$0</span></li>
                      </ul>
                      <div class="animate-chk">
                         <div class="row">
                            <div class="col">
                                <input class="form-check-input" id="gridCheck" name="concent" type="checkbox">
                                <label class="form-check-label" name="consent" for="gridCheck" required>Use the payment method on file</label>
                            </div>
                         </div>
                      </div>
                   </div>
                </div>
             </div>
             <div class="col-lg-12 col-sm-12">
                 <div class="form-group row mt-2 mb-4">
                    <div class="col-md-6">
                        <label class="col-form-label">Number of selected packages</label>
                        <input class="form-control" type="Number" id="package-number" name="number_of_selected_package" placeholder="Enter pacakges number">
                    </div>
                    <div class="col-md-6">
                        <label class="col-form-label">Number of selected user</label>
                        <input class="form-control" id="user-number" type="Number" name="number_of_selected_user" placeholder="Enter user number">
                    </div>
                 </div>
                 <div class="form-group row mt-4">
                      <div class="col">
                          <label class="d-block" for="edo-ani">
                          <input class="radio_animated" id="edo-ani" type="radio" name="description" value="Share same package between users" checked="true">Share same package between users (Only one number of people can call at a time)
                          </label>
                          <label class="d-block" for="edo-ani1">
                          <input class="radio_animated" id="edo-ani1" type="radio" name="description" value="Purchase separate every package for each user">Purchase separate every package for each user (Every one can call at same time)
                          </label>
                          <label class="d-block" for="edo-ani2">
                          <input class="radio_animated" id="edo-ani2" type="radio" name="description" value="Customize">Customize (You chose how to distribute)
                          </label>
                      </div>
                 </div>

                 <div class="col-md-12 user-section" style="display: none">
                 <h6>List of users</h6>
                 </div>
                 <div class="form-group row mt-2 mb-4  append-list user-section" style="display: none">
                 </div>
             </div>
          </div>
       </div>
       <div class="card-footer">
        <button class="btn btn-secondary">Submit</button>
    </div>
    </form>
    </div>
 </div>
@endsection

@section('script')
<script src="{{asset('backend/js/dashboard/default.js')}}"></script>

<script>
    var packagePrice = null;
    var userNumber = null;
    var userCost = 0;
    var packageNumber = 1;
    var subtotal = null;
    var taxes = 0;
    var dilevery = 0;
    var total = null;

    //getting records
    function changePrice(){
        packagePrice = $("input[type='radio']:checked").data("price");
        $(".package-cost").text('$ ' + packagePrice * packageNumber);
    }
    function changeSubtotalPrice(){
        subtotal = parseFloat( (packagePrice * packageNumber) + userCost );
        $(".subtotal").text('$ ' + subtotal);
    }

    function changeUserCost(){
        userCost = 5*userNumber;
        $(".user-cost").text('$ ' +userCost);
        manageUserInputs();
    }
    function changeTotalPrice(){
        total = parseFloat(subtotal + taxes + dilevery);
        console.log(total);
        $("#total-cost").text('$' + total);
    }

    function manageUserInputs(){


        if(userNumber > 0){
            $('.user-section').show();
            $('.append-list').html("");
            for($i=0; $i<userNumber; $i++){
                $('.append-list').append("<div class='col-md-2'><label class='col-form-label'>ID</label><input class='form-control' type='Number' id='' name='user_id[]' placeholder=''></div><div class='col-md-4'><label class='col-form-label'>Name</label><input class='form-control' id='' type='text' name='user_name[]' placeholder='Enter name'></div><div class='col-md-4'><label class='col-form-label'>Email</label><input class='form-control' id='' type='email' name='user_email[]' placeholder='Enter email'></div><div class='col-md-2'><label class='col-form-label'>Will Share</label><select class='form-control digits' name='user_share[]' id='exampleFormControlSelect9'><option value='1' selected>Yes</option><option value='0'>No</option></select></div>");
            }
        }else{
            $('.user-section').hide();
            $('.append-list').html("");
        }
    }

    $(".package-radio").click(function(){
        changePrice();
        changeUserCost();
        changeSubtotalPrice()
        changeTotalPrice()
    });

    $("#user-number").keyup(function(e){
        userNumber = this.value;
        changePrice();
        changeUserCost();
        changeSubtotalPrice()
        changeTotalPrice()

    });

    $("#package-number").keyup(function(e){
        packageNumber = this.value;
        changePrice();
        changeUserCost();
        changeSubtotalPrice()
        changeTotalPrice()
    });

    // assigning and calculating record
</script>
@endsection
