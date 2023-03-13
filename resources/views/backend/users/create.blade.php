@extends('backend.layouts.dashboard.master')

@section('title', 'Users')

@section('css')

<link rel="stylesheet" type="text/css" href="{{asset('backend/css/vendors/animate.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('backend/css/vendors/datatables.css')}}">

@endsection

@section('style')

@endsection



@section('breadcrumb-title')

<h3>Create new user</h3>

@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{route('admin.users.index')}}">Manage Users</a></li>
<li class="breadcrumb-item">Create New User</li>

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
                            
                            <div class="col-sm-8"><h5>Create New User</h5></div>
                            <div class="col-sm-4">
                                <button type='button' id="AddBtn" class="btn-info btn-md" onclick="addRow();"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="{{route('admin.users.store')}}" method="post" id="myform">
                            @csrf
                            <div class="mt-2 mb-4  append-list user-section">

                            </div>
                        </form>
                    </div>

                </div>

            </div>

        </div>
    </div>
@endsection

@section('script')

<script src="{{asset('backend/js/dashboard/default.js')}}"></script>
<script>
var PackageList = <?php echo  (count($packages) > 0) ? json_encode($packages) : ''; ?>;
var addId = 0;
function addRow() {
    let selectOption = '<option value="">select Package</option>';
    $.each(PackageList,function(index,value){
        selectOption += '<option value="'+value['package_id']+'" data-index="'+index+'">'+value['package_name']+'</option>';
    });
    selectOption+= '<option value="-1">User you own SIP Account</option>';

    let htmlDiv = "<div class='form-group row' id='remove"+addId+"'><div class='col-md-3'><label class='col-form-label'>Name</label><input class='form-control' id='' type='text' name='user_name[]' placeholder='Enter name' required></div><div class='col-md-3'><label class='col-form-label'>Email</label><input class='form-control' id='user_email"+addId+"' type='email' required name='user_email[]' placeholder='Enter email' onblur='CheckUniqueEmail(this.value,"+addId+");'></div><div class='col-md-4'><label class='col-form-label'>Select Package</label><input type='hidden' name='user_package[]' id='user"+addId+"' /><select class='form-control packageSelect' name='user_share[]' id='exampleFormControlSelect"+addId+"' required data-main='"+addId+"' onchange='changeOtion(this);' onfocus='oldValueDeSelect(this);'>"+selectOption+"</select></div><div class='col-md-2'><button type='button' style='margin-top: 25%;' class='btn-danger btn-md' onclick='removeRow("+addId+");'><i class='fa fa-close'></i></button></div></div>";

    addId++;
    $('.append-list').append(htmlDiv);

}

function removeRow(ids)
{
    $('#remove'+ids).remove();
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
    
    if($('#'+selOptionId+' option:selected').val() === -1) {
        $('#spiDiv'+index).show();
    } else {
        $('#spiDiv'+index).hide();
    }
}

$(document).ready(function () {
    addRow();
});
</script>
@endsection