@extends('backend.layouts.dashboard.master')

@section('title', 'Users')

@section('css')

<link rel="stylesheet" type="text/css" href="{{asset('backend/css/vendors/animate.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('backend/css/vendors/datatables.css')}}">

@endsection

@section('style')

@endsection



@section('breadcrumb-title')

<h3>Create new Package</h3>

@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{route('admin.packages.index')}}">Manage Packages</a></li>
<li class="breadcrumb-item">Create New Package</li>

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

    
        <form action="{{route('admin.packages.store')}}" method="post" id="myform">
        @csrf

            <div class="row">

                <div class="col-sm-8">

                    <div class="card">

                        <div class="card-header">

                            <div class="row">
                                
                                <div class="col-sm-8"><h5>Create New Package</h5></div>
                            </div>
                        </div>

                        <div class="card-body">
                            
                            <div class="row">
                                <div class="col-lg-12 col-sm-12">
                                    <div class="row">

                                        <div class="form-group col-md-6">

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
                            </div>
                        </div>

                        <div class="card-footer">
                            <button class="btn btn-secondary">Next</button>
                        </div>
                    </div>

                </div>

                <div class="col-sm-4">

                    <div class="checkout-details" style="background-color: #f9f9f9; border: 1px solid #dddddd; padding: 40px;">

                        <div class="order-box">
                            <div class="row">
                                <div class="col-sm-8"><h5>Package Details</h5></div>
                            </div>
                            <ul class="qty" id="PackageCost">

                                

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
            </div>

        </form>

    </div>
@endsection

@section('script')
<script src="{{asset('backend/js/dashboard/default.js')}}"></script>
<script>

var PackageList = <?php echo  (count($packages) > 0) ? json_encode($packages) : ''; ?>;
var countries = <?php echo  (count($countries) > 0) ? json_encode($countries) : ''; ?>;
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
    $('#PackageCost').html('');
    packagePrice = parseFloat(0);
    let pid = 0;
    selectPackageArr = [];
    $(".package-number").each(function(index,value){
        let tempNumber = parseInt($(value).val()); 
        let tempPrice = $(value).data("price");

        if (tempNumber > 0)
        {
            $('#PackageCost').append('<li>'+$(value).data("name")+':<span class="package-cost">$'+(parseFloat(tempPrice) * parseInt(tempNumber)) +'</span></li>');
             
            packagePrice = parseFloat(packagePrice) + (parseFloat(tempPrice) * parseInt(tempNumber));
        }

    });   

    $("#total-cost").text('$' + packagePrice);
}
</script>
@endsection