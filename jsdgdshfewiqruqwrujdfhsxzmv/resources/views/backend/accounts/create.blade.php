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

                                                <!-- <div class="radio radio-primary mr-3">

                                                    <input id="radio23{{$key}}" class="package-radio" type="radio" name="package_id" value="{{$package->package_id}}" data-price="{{$package->price}}">

                                                    <label for="radio23{{$key}}"></label>

                                                </div> -->

                                                <div class="media-body">
                                                    <h6 class="mt-0 mega-title-badge">{{$package->package_name}} 
                                                        <input style="width:45px;"  min="0" id="number23{{$key}}" class="package-number packageInput" type="number" name="package_id" value="0" data-a="{{$key}}" data-price="{{$package->price}}" data-name="{{$package->package_name}}" data-id="{{$package->package_id}}" max="20">
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

                    <!-- <div class="col-md-6">

                        <label class="col-form-label">Number of selected packages</label>

                        <input class="form-control" type="Number" id="package-number" name="number_of_selected_package" placeholder="Enter pacakges number">

                    </div> -->

                    <div class="col-md-6">

                        <label class="col-form-label">Number of selected user</label>

                        <input class="form-control" id="user-number" type="Number" name="number_of_selected_user" placeholder="Enter user number">

                    </div>

                 </div>

                 <!-- <div class="form-group row mt-4">

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

                 </div> -->



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
var packagePrice = parseFloat(0);
var userCost = parseFloat(0);
var userNumber = parseInt(0);
var subtotal = parseFloat(0);
var taxes = parseFloat(0);
var dilevery = parseFloat(0);
var selectPackageArr = [];
$(".package-number").bind('keyup mouseup', function () {
    changePrice($(this).attr('id'));           
});
function changePrice(id = ''){
    packagePrice = parseFloat(0);
    selectPackageArr = [];
    $(".package-number").each(function(index,value){
        let tempNumber = $(value).val(); 
        let tempPrice = $(value).data("price");
        packagePrice = parseFloat(packagePrice) + (parseFloat(tempPrice) * parseInt(tempNumber))

        if (tempNumber > 0)
        {
            for (let index = 0; index < tempNumber; index++) {
                selectPackageArr.push({'package_id':$(value).data("id"),'name':$(value).data("name")});
            }            
        }
    });    
    $(".package-cost").text('$ ' + packagePrice);
    changeUserCost();
}
function changeUserCost(){
    userCost = 5 * parseInt(userNumber);
    $(".user-cost").text('$ ' + userCost );
    changeSubtotalPrice();
    if(userNumber > 0) {
        manageUserInputs();
    }
}
function changeSubtotalPrice(){
    subtotal = parseFloat( packagePrice + userCost );
    $(".subtotal").text('$ ' + subtotal);
    changeTotalPrice();
}
function changeTotalPrice(){
    let total = parseFloat(subtotal + taxes + dilevery);
    $("#total-cost").text('$' + total);
}
$("#user-number").on('change',function(e){
    userNumber = this.value;
    changeUserCost();
    manageUserInputs();
});
function manageUserInputs(){
    if(userNumber > 0) {
        $('.user-section').show();
        $('.append-list').html("");
        let selectOption = '<option value="">select Package</option>';
        $.each(selectPackageArr,function(index,value){
            selectOption += '<option value="'+value['package_id']+'" data-index="'+index+'">'+value['name']+'</option>';
        });
        for($i=0; $i<userNumber; $i++){
            $('.append-list').append("<div class='col-md-4'><label class='col-form-label'>Name</label><input class='form-control' id='' type='text' name='user_name[]' placeholder='Enter name'></div><div class='col-md-4'><label class='col-form-label'>Email</label><input class='form-control' id='' type='email' name='user_email[]' placeholder='Enter email'></div><div class='col-md-4'><label class='col-form-label'>Select Package</label><select class='form-control packageSelect' name='user_share[]' id='exampleFormControlSelect"+$i+"' onchange='changeOtion(this);'>"+selectOption+"</select></div>");
        }
    } else {
        $('.user-section').hide();
        $('.append-list').html("");
    }
}
function changeOtion(obj) {
    let isSelected = true;
    let selOptionId = $(obj).attr('id');
    let selOptionIndex = $('#'+selOptionId+' option:selected').data('index');
    if(selOptionIndex == undefined){
        isSelected = false;
        $($('#'+selOptionId).find('option')).each(function(index,value){
            if($(value).is(':disabled')){
                selOptionIndex = $(value).data('index');
            }
        });
        // selOptionIndex =  $('#'+selOptionId).find('option').find("disabled").data('index');
        // console.log($('#'+selOptionId).find('option'));
    }
    console.log('isSelected : ',isSelected,selOptionIndex);
    $('.packageSelect').each(function(ind,value){
        let id = $(value).attr('id');
        let selIndex = $('#'+id+' option:selected').data('index');
        let selValue = $('#'+id+' option:selected').val();
        if(selIndex != undefined) {
            if(selValue != 7) {
                $('.packageSelect option[data-index="'+selIndex+'"]').attr('disabled',true);
            }
        }

        
        if(!isSelected)
            $('.packageSelect option[data-index="'+selOptionIndex+'"]').attr('disabled',false);
        
    });
}
</script>

@endsection

