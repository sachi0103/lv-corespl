@extends('backend.layouts.dashboard.master')

@section('title', 'Dashboard')



@section('css')

<link rel="stylesheet" type="text/css" href="{{asset('backend/css/vendors/animate.css')}}">
<meta name="_token" content="{{csrf_token()}}" />
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

       <form action="{{route('admin.accounts.store')}}" method="post" id="myform">

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

                                <div class="row" id="packageList">

                                    @foreach ($packages as $key => $package )
                                    
                                    @if (strtolower($countries[0]->Name) == strtolower($package->call_country))

                                    <div class="col-sm-6">

                                        <div class="card">

                                            <div class="media p-20">

                                                <div class="media-body">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <h6 class="mt-0 mega-title-badge">{{$package->package_name}} 
                                                                <br>  <span class="badge badge-secondary pull-right digits mt-1" style="float: left;">USD {{$package->price}} </span>
                                                            </h6>
                                                            <br>
                                                            <p class="mt-1">Package Type: {{$package->package_type}}</p>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label><b>Qty:</b></label>
                                                            <input type="hidden" name="package_id[]" value="{{$package->package_id}}" />
                                                            <input style="width:45px;border: solid #000 1px;"  min="0" id="number23{{$key}}" class="package-number packageInput" onchange="changePrice('number23{{$key}}');" type="number" name="package_qty[]" value="0" data-a="{{$key}}" data-price="{{$package->price}}" data-name="{{$package->package_name}}" data-id="{{$package->package_id}}" max="20">
                                                        </div>
                                                    </div>                                                    
                                                    
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    @endif

                                    @endforeach

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

                        <label class="col-form-label">Number of Employees</label>

                        <input class="form-control" id="user-number" required type="Number" name="number_of_selected_user" placeholder="Enter Number of Employees">

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

        <button class="btn btn-secondary">Next</button>

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
var PackageList = <?php echo  (count($packages) > 0) ? json_encode($packages) : ''; ?>;
var countries = <?php echo  (count($countries) > 0) ? json_encode($countries) : ''; ?>;
var perUserCost = parseFloat(countries[0]['user_cost']);
$(".package-number").bind('keyup mouseup', function () {
    changePrice($(this).attr('id'));           
});
$('#exampleFormControlSelect9').on('change',function(){
    let country = ($('#exampleFormControlSelect9 option:selected').text()).toLowerCase();
    
    let filterPackage = PackageList.filter( function(value,index) {
        return (country == (value['call_country']).toLowerCase())
        //console.log(value['call_country']);
    } );

    let selCountry = countries.filter( function (val,ind) {
            return (val['ID'] == $('#exampleFormControlSelect9 option:selected').val());
    });
    if(selCountry[0] != undefined) {
        perUserCost = parseFloat(selCountry[0]['user_cost']);
    } else {
        perUserCost = parseFloat(0);
    }

    let packageList = '';
    $.each(filterPackage,function(index,value){
        let idVal = 'number23'+index;
        packageList += '<div class="col-sm-6">'+
                            '<div class="card">'+
                                '<div class="media p-20">'+
                                    '<div class="media-body">'+
                                        '<div class="row">'+
                                            '<div class="col-md-8">'+
                                                '<h6 class="mt-0 mega-title-badge">'+value['package_name'] +
                                                    '<br>  <span class="badge badge-secondary pull-right digits mt-1" style="float: left;">USD '+value['price']+' </span>'+
                                                '</h6>'+
                                                '<br>'+
                                                '<p class="mt-1">Package Type: '+value['package_type']+'</p>'+
                                            '</div>'+
                                            '<div class="col-md-4">'+
                                                '<label><b>Qty:</b></label>'+
                                                '<input type="hidden" name="package_id[]" value="'+value['package_id']+'" />'+
                                                '<input style="width:45px;border: solid #000 1px;"  min="0" id="number23'+index+'" class="package-number packageInput" type="number" onchange="changePrice(\''+idVal+'\');" name="package_qty[]" value="0" data-a="'+index+'" data-price="'+value['price']+'" data-name="'+value['package_name']+'" data-id="'+value['package_id']+'" max="20">'+
                                            '</div>'+
                                        '</div>'+                                              
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>';
    });

    $('#packageList').html(packageList);
    changePrice();
});
function changePrice(id = ''){
    packagePrice = parseFloat(0);
    let pid = 0;
    selectPackageArr = [];
    let noEmp = parseInt(0);
    $(".package-number").each(function(index,value){
        let tempNumber = parseInt($(value).val()); 
        let tempPrice = $(value).data("price");
        packagePrice = parseFloat(packagePrice) + (parseFloat(tempPrice) * parseInt(tempNumber))

        if (tempNumber > 0)
        {
            if(jQuery.inArray(parseInt($(value).data("id")), [7,8] ) != -1) {
                pid = $(value).data("id");
                selectPackageArr.push({'package_id':$(value).data("id"),'name':$(value).data("name")});
            } else{

                for (let index = 0; index < tempNumber; index++) {
                    selectPackageArr.push({'package_id':$(value).data("id"),'name':$(value).data("name")});
                }
            }       
            
            noEmp += tempNumber;
        }
    });   
    
    if(jQuery.inArray(parseInt(pid), [7,8] ) !== -1) {
        $('#user-number').removeAttr('max');
    } else {
        $('#user-number').prop('max',noEmp);
    }
        $('#user-number').prop('min',noEmp);
    $('#user-number').val(noEmp);
    userNumber = noEmp;
    $(".package-cost").text('$ ' + packagePrice);
        changeUserCost();
    if(userNumber > 0) {
        manageUserInputs();
    }
}
function changeUserCost(){
    let UnlimitedShareCount = parseInt(0);
    $('.packageSelect').each(function(ind,value){
        let id = $(value).attr('id');
        let selValue = $('#'+id+' option:selected').val();

        if(jQuery.inArray( parseInt(selValue), [7,8] ) !== -1) {
            UnlimitedShareCount+= 1;
        }        
    });

    userCost = (UnlimitedShareCount > 1) ? perUserCost * (UnlimitedShareCount - 1) : 0;
    $(".user-cost").text('$ ' + userCost );
    changeSubtotalPrice();
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
            $('.append-list').append("<div class='col-md-4'><label class='col-form-label'>Name</label><input class='form-control' id='' type='text' name='user_name[]' placeholder='Enter name' required></div><div class='col-md-4'><label class='col-form-label'>Email</label><input class='form-control' id='user_email"+$i+"' type='email' required name='user_email[]' placeholder='Enter email' onblur='CheckUniqueEmail(this.value,"+$i+");'></div><div class='col-md-4'><label class='col-form-label'>Select Package</label><input type='hidden' name='user_package[]' id='user"+$i+"' /><select class='form-control packageSelect' name='user_share[]' id='exampleFormControlSelect"+$i+"' required data-main='"+$i+"' onchange='changeOtion(this);' onfocus='oldValueDeSelect(this);'>"+selectOption+"</select></div>");
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
    let index = $(obj).data('main');
    $('#user'+index).val($('#'+selOptionId+' option:selected').val());
    if(selOptionIndex == undefined){
        isSelected = false;
        $($('#'+selOptionId).find('option')).each(function(index,value){
            if($(value).is(':disabled')){
                selOptionIndex = $(value).data('index');
            }
        });
    }
    $('.packageSelect').each(function(ind,value){
        UnlimitedShareCount = parseInt(1);
        let id = $(value).attr('id');
        let selIndex = $('#'+id+' option:selected').data('index');
        let selValue = $('#'+id+' option:selected').val();
        if(selIndex != undefined) {
            if(jQuery.inArray( parseInt(selValue), [7,8] ) === -1) {
                $('.packageSelect option[data-index="'+selIndex+'"]').attr('disabled',true);
            }
        }

        if(jQuery.inArray( parseInt(selValue), [7,8] ) !== -1) {
            UnlimitedShareCount+= 1;
        }

        
        if(!isSelected)
            $('.packageSelect option[data-index="'+selOptionIndex+'"]').attr('disabled',false);
        
    });
    changeUserCost();
}

function oldValueDeSelect(obj)
{
    let selOptionId = $(obj).attr('id');
    let selOptionIndex = $('#'+selOptionId+' option:selected').data('index');
    let index = $(obj).data('main');
    $('.packageSelect').each(function(ind,value){
        $('.packageSelect option[data-index="'+index+'"]').attr('disabled',false);
    });
}

$('#myform').submit(function() {
  // your code here
  let isReturn = true;
  let emailArr = [];
  $('input[name="user_email[]"]').each(function(index,currentObj){
        if(jQuery.inArray($(currentObj).val(), emailArr) !== -1) {
            isReturn = false;
        } else {            
            emailArr.push($(currentObj).val());
        }
        console.log($(currentObj).val());
  });
  if(!isReturn) {
    alert('Please enter unique email address')
  }

  return isReturn;
});

function CheckUniqueEmail(email,id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    $.ajax({
        method: 'POST',
        url: '/call-recall/ajaxUniqueEmail',
        dataType: 'json',
        data: {email: email},
        success:function(data){
            if(data.status){
                alert('This email is already used. Please enter unique email address');
                $('#user_email'+id).val('');
            }
        }
    })
}

</script>

@endsection

