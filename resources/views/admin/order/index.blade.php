@extends('layouts.app')


@section('content')
<style>
    /* Compact Order Filters */
    .order-filter-box {
        padding: 10px !important;
        margin-bottom: 12px !important;
    }

    .order-filter-box .form-row {
        margin-left: -5px;
        margin-right: -5px;
    }

    .order-filter-box .form-group {
        padding-left: 5px;
        padding-right: 5px;
        margin-bottom: 7px;
    }

    .order-filter-box label {
        font-size: 12px;
        margin-bottom: 3px;
    }

    .order-filter-box .form-control {
        height: 34px;
        padding: 5px 9px;
        font-size: 12px;
    }

    .order-filter-box button {
        padding: 5px 12px;
        font-size: 12px;
        line-height: 1.4;
    }
</style>
<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-12">


            @if(Session::has('success'))

            <div class="alert alert-success alert-dismissible fade show">

                {{ Session::get('success') }}

            </div>

            @endif


            {{-- =====================================================
                 ORDER CARD
            ====================================================== --}}

            <div class="card">


                <div class="card-header">

                    <strong>
                        Orders
                    </strong>

                </div>


                <div class="card-body">


                    {{-- =================================================
                         FILTERS
                    ================================================== --}}

                    <div class="border rounded order-filter-box">

                        <div class="form-row">


                            {{-- ORDER NUMBER --}}

                            <div class="form-group col-md-2">

                                <label>
                                    Order Number
                                </label>

                                <input
                                    type="text"
                                    id="filter_order_number"
                                    class="form-control"
                                    placeholder="OF260811...">

                            </div>


                            {{-- MOBILE --}}

                            <div class="form-group col-md-2">

                                <label>
                                    Mobile
                                </label>

                                <input
                                    type="text"
                                    id="filter_mobile"
                                    class="form-control"
                                    placeholder="Mobile number">

                            </div>


                            {{-- STATUS --}}

                            <div class="form-group col-md-2">

                                <label>
                                    Status
                                </label>

                                <select
                                    id="filter_status"
                                    class="form-control">

                                    <option value="">
                                        All Status
                                    </option>

                                    <option value="placed">
                                        Placed
                                    </option>

                                    <option value="confirmed">
                                        Confirmed
                                    </option>

                                    <option value="printing">
                                        Printing
                                    </option>

                                    <option value="ready_to_ship">
                                        Ready to Ship
                                    </option>

                                    <option value="shipped">
                                        Shipped
                                    </option>

                                    <option value="out_for_delivery">
                                        Out for Delivery
                                    </option>

                                    <option value="delivered">
                                        Delivered
                                    </option>

                                    <option value="cancelled">
                                        Cancelled
                                    </option>

                                </select>

                            </div>


                            {{-- DATE FROM --}}

                            <div class="form-group col-md-2">

                                <label>
                                    Date From
                                </label>

                                <input
                                    type="date"
                                    id="filter_date_from"
                                    class="form-control">

                            </div>


                            {{-- DATE TO --}}

                            <div class="form-group col-md-2">

                                <label>
                                    Date To
                                </label>

                                <input
                                    type="date"
                                    id="filter_date_to"
                                    class="form-control">

                            </div>


                        </div>


                        <div>

                            <button
                                type="button"
                                id="applyFilter"
                                class="btn btn-primary">

                                Filter

                            </button>


                            <button
                                type="button"
                                id="clearFilter"
                                class="btn btn-secondary">

                                Clear

                            </button>

                        </div>

                    </div>


                    {{-- =================================================
                         TABLE
                    ================================================== --}}

                    <div class="table-responsive">

                        <table
                            class="table table-bordered datatable"
                            style="width:100%;">

                            <thead>

                                <tr>

                                    <th>
                                        No
                                    </th>

                                    <th>
                                        Order
                                    </th>

                                    <th>
                                        Customer
                                    </th>

                                    <th>
                                        Courier
                                    </th>

                                    <th>
                                        Payment
                                    </th>

                                    <th>
                                        Total
                                    </th>

                                    <th>
                                        Status
                                    </th>

                                    <th>
                                        Date
                                    </th>

                                    <th width="70">
                                        Action
                                    </th>

                                </tr>

                            </thead>


                            <tbody>

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


<script>
    $(document).ready(function() {


        /*
        =====================================================
        DATATABLE
        =====================================================
        */

        var table = $('.datatable').DataTable({

            processing: true,

            serverSide: true,

            ajax: {

                url: "{{ route('admin.get_orders') }}",

                data: function(d) {

                    d.order_number =
                        $('#filter_order_number').val();

                    d.mobile =
                        $('#filter_mobile').val();

                    d.status =
                        $('#filter_status').val();

                    d.date_from =
                        $('#filter_date_from').val();

                    d.date_to =
                        $('#filter_date_to').val();

                }

            },


            columns: [

                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },


                {
                    data: 'order_number_display',
                    name: 'order_number',
                    orderable: false
                },


                {
                    data: 'customer',
                    name: 'full_name',
                    orderable: false
                },


                {
                    data: 'courier',
                    name: 'courier_name',
                    orderable: false
                },


                {
                    data: 'payment',
                    name: 'payment_method',
                    orderable: false
                },


                {
                    data: 'total',
                    name: 'grand_total'
                },


                {
                    data: 'status_badge',
                    name: 'status',
                    orderable: false
                },


                {
                    data: 'order_date',
                    name: 'created_at'
                },


                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }

            ],

            order: [
                [
                    7,
                    'desc'
                ]
            ]

        });


        /*
        =====================================================
        APPLY FILTER
        =====================================================
        */

        $('#applyFilter').on(
            'click',
            function() {

                table.ajax.reload();

            }
        );


        /*
        =====================================================
        CLEAR FILTER
        =====================================================
        */

        $('#clearFilter').on(
            'click',
            function() {

                $('#filter_order_number')
                    .val('');

                $('#filter_mobile')
                    .val('');

                $('#filter_status')
                    .val('');

                $('#filter_date_from')
                    .val('');

                $('#filter_date_to')
                    .val('');


                table.ajax.reload();

            }
        );


    });
</script>

@endsection