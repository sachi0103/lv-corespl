@extends('backend.layouts.dashboard.master')

@section('title', 'Dashboard')



@section('css')

<link rel="stylesheet" type="text/css" href="{{asset('backend/css/vendors/animate.css')}}" />
<link rel="stylesheet" type="text/css" href="https://cdn3.devexpress.com/jslib/22.1.6/css/dx.common.css" />
<link rel="stylesheet" type="text/css" href="https://cdn3.devexpress.com/jslib/22.1.6/css/dx.light.css" />
@endsection



@section('style')
<style>
    #gridContainer {
        height: 440px;
    }

    .master-detail-caption {
        padding: 0 0 5px 10px;
        font-size: 14px;
        font-weight: bold;
    }
</style>
@endsection



@section('breadcrumb-title')

<h3>View Payments</h3>

@endsection



@section('breadcrumb-items')

<li class="breadcrumb-item">Manage Payments</li>

<li class="breadcrumb-item">View Payments</li>

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

                            <h5>Payments Information</h5>

                        </div>

                        <div class="card-body">
                                <div id="payment-table"></div>
                        </div>

                    </div>

                </div>

            </div>

        </div>

@endsection

@section('script')

<script src="{{asset('backend/js/dashboard/default.js')}}"></script>
<script src="https://cdn3.devexpress.com/jslib/22.1.6/js/dx.all.js"></script>
<script type="text/javascript">
$(function () {
    var payment = <?php echo (!empty($payments)) ? json_encode($payments) : '[]'; ?>;
    $('#payment-table').dxDataGrid({
        dataSource: payment,
        keyExpr: 'id',
        showBorders: true,
        paging: {
            pageSize: 15,
        },
        filterRow: {
            visible: false,
            applyFilter: 'auto',
        },
        searchPanel: {
            visible: true,
            width: 240,
            placeholder: 'Search...',
        },
        headerFilter: {
            visible: true,
        },
        columns: [
            {
                dataField: 'no_of_users',
                caption: 'Number of User',
            },
            {
                dataField: 'number_of_packages',
                caption: 'Number of Packages',
            },
            {
                dataField: 'subtotal',
                caption: 'Subtotal',
            },
            {
                dataField: 'charge_per_user',
                caption: 'User Cost',
            },
            {
                dataField: 'total',
                caption: 'Total',
            },
            {
                dataField: 'created_at',
                caption: 'Created',
                dataType: 'date',
            },
        ],
        masterDetail: {
            enabled: true,
            template(container, options) {
                const currentUserData = options.data.payment_users;
                $('<div>')
                .addClass('master-detail-caption')
                .text(`User Details: `)
                .appendTo(container);

                $('<div>')
                .dxDataGrid({
                    columnAutoWidth: true,
                    showBorders: true,
                    dataSource: currentUserData,
                    keyExpr: 'id',
                    columns: [
                        {
                            dataField: 'id',
                            caption: 'Name',
                            calculateCellValue: function (colData) {
                                return colData.user.name;
                            }
                        },
                        {
                            dataField: 'payment_id',
                            caption: 'Email',
                            calculateCellValue: function (colData) {
                                return colData.user.email;
                            }
                        },            
                        {
                            dataField: 'package_id',
                            caption: 'Package',
                            calculateCellValue: function (rowData) {
                                return (rowData.package != null ) ? rowData.package.package_name : '';
                            }
                        },           
                        {
                            dataField: 'user_id',
                            caption: 'Price',
                            calculateCellValue: function (rowData) {
                                return (rowData.package != null ) ? rowData.package.price : '';
                            }
                        },
                    ],
                }).appendTo(container);
            },
        },
    });
});
</script>
@endsection

