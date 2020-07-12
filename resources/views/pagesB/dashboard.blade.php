@extends('pagesB.master')
@section('title_admin')
DashBoard | Admin | COZA
@endsection
@section('contentserver')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<div class="content">
            <!-- Animated -->
            <div class="animated fadeIn">
                <!-- Widgets  -->
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body" style="padding: 17px 15px;">
                                <div class="stat-widget-one">
                                    <div class="stat-icon dib"><i class="ti-money text-success border-success"></i></div>
                                    <div class="stat-content dib">
                                        <div class="stat-text">Total Profit</div>
                                        <div class="stat-digit">{{ $revenue }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-1">
                                        <i class="pe-7s-cash"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text">$<span>{{ $revenue*0.9 }}</span></div>
                                            <div class="stat-heading">Revenue</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-2">
                                        <i class="pe-7s-cart"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text"><span class="count">{{ count($countorder) }}</span></div>
                                            <div class="stat-heading">Orders</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-3">
                                        <i class="ti-server text-muted" style="font-size: 42px;"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text"><span class="count">{{ count($products) }}</span></div>
                                            <div class="stat-heading">Products</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body" style="padding: 23px 15px;">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-4">
                                        <i class="pe-7s-users"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text"><span class="count">{{ $users }}</span></div>
                                            <div class="stat-heading">Users</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body" style="padding: 23px 15px;">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-4">
                                        <i class="ti-user text-muted" style="font-size: 42px;"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text"><span class="count">{{ count($clients) }}</span></div>
                                            <div class="stat-heading">Clients</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-one">
                                    <div class="stat-icon dib"><i class="ti-link text-danger border-danger"></i></div>
                                    <div class="stat-content dib">
                                        <div class="stat-text">Vendors</div>
                                        <div class="stat-digit">{{ $vendors }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-3">
                        <div class="card text-white bg-flat-color-2">
                            <div class="card-body" style="padding:20px 15px;">
                                <div class="card-left pt-1 float-left">
                                    <h3 class="mb-0 fw-r">
                                        <span class="count">1490</span>
                                    </h3>
                                    <p class="text-light mt-1 m-0">Access Times</p>
                                </div><!-- /.card-left -->

                                <div class="card-right float-right text-right">
                                    <i class="ti-pulse text-muted" style="font-size: 60px;"></i>
                                </div><!-- /.card-right -->

                            </div>

                        </div>
                    </div>

                </div>
                <div class="row">
                    <h6 style="padding: 0px 0px 12px 12px;
    font-weight: 600;
    font-size: 24px;">Today Overview</h6>
                </div>
                <div class="row">
                     <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body" style="padding: 30px 15px;">
                                <div class="stat-widget-four">
                                    <div class="stat-icon dib">
                                        <i class="ti-stats-up text-muted"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-heading">Today Order</div>
                                            <div class="stat-text">{{ $todaysale }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-3">
                        <div class="card text-white bg-flat-color-1">
                            <div class="card-body">
                                <div class="card-left pt-1 float-left" style="width: 65%;">
                                    <h3 class="mb-0 fw-r">
                                        <span class="currency float-left mr-1">$</span>
                                        <span class="count">{{ $todayrevenue }}</span>
                                    </h3>
                                    <p class="text-light mt-1 m-0">Today Revenue</p>
                                </div><!-- /.card-left -->

                                <div class="card-right float-right text-right" style="width: 35%;">
                                    <i class="icon fade-5 icon-lg pe-7s-cart"></i>
                                </div><!-- /.card-right -->
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body" style="padding: 24px 15px;">
                                <div class="stat-widget-one">
                                    <div class="stat-icon dib"><i class="ti-user text-primary border-primary"></i></div>
                                    <div class="stat-content dib">
                                        <div class="stat-text">New Customer</div>
                                        <div class="stat-digit">{{ $newuser }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Widgets -->
                <!--  Traffic  -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="box-title">Traffic Order - Revenue - Total Price</h4>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card-body">
                                        <canvas id="TrafficChart"></canvas>  
                                    </div>
                                </div>
                            </div>
                        </div> <!-- /.row -->
                            <div class="card-body"></div>
                        </div>
                    </div><!-- /# column -->
                </div>
                <!--  /Traffic -->
                <div class="clearfix"></div>
                <!-- Orders -->
                <div class="orders">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="box-title">Orders </h4>
                                </div>
                                <div class="card-body--">
                                    <div class="table-stats order-table ov-h">
                                        <table class="table ">
                                            <thead>
                                                <tr>
                                                    <th class="serial">ID</th>
                                                    <th class="avatar">Avatar</th>
                                                    <th>Name</th>
                                                    <th>Quantity</th>
                                                    <th>Money</th>
                                                    <th style="text-align: center;">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach( $orders as $order )
                                                <tr>
                                                    <td class="serial">{{ $order->code_order }}</td>
                                                    <td class="avatar">
                                                        <div class="round-img">
                                                            <a href="javascript:void(0)"><img src="public/assetF/images/avatar/{{ $order->avatar }}" alt=""></a>
                                                        </div>
                                                    </td>
                                                    <td>  <span class="name">{{ $order->name_recipient }}</span> </td>
                                                    <td> <span class="product">{{ $order->total_quantity }}</span> </td>
                                                    <td>$<span class="count"> {{ $order->total_money }}</span></td>
                                                    <td>
                                                        @if( $order->status == 0 && $order->status_order == 1 )
                                                        <span class="badge badge-pending">Pending</span>
                                                        @elseif( $order->status == 1 && $order->status_order == 1 )
                                                        <span class="badge badge-complete">Delivery</span>
                                                        @elseif( $order->status == 2 && $order->status_order == 1 )
                                                        <span class="badge badge-complete">Complete</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div> <!-- /.table-stats -->
                                </div>
                            </div> <!-- /.card -->
                        </div>  <!-- /.col-lg-8 -->
                    </div>
                </div>
            <!-- /#add-category -->
            </div>
            <!-- .animated -->
        </div>
<script type="text/javascript">
    jQuery(document).ready(function($){
        if ($('#TrafficChart').length) {
                var ctx = document.getElementById( "TrafficChart" );
                ctx.height = 150;
                var myChart = new Chart( ctx, {
                    type: 'line',
                    data: {
                        labels: [@foreach( $arr_month as $month )'{{$month}}', @endforeach],
                        datasets: [
                        {
                            label: "Order",
                            borderColor: "rgba(4, 73, 203,.09)",
                            borderWidth: "1",
                            backgroundColor: "rgba(4, 73, 203,.5)",
                            data: [@foreach( $arr_countorder as $count )'{{$count}}', @endforeach]
                        },
                        {
                            label: "Revenue",
                            borderColor: "rgba(245, 23, 66, 0.9)",
                            borderWidth: "1",
                            backgroundColor: "rgba(245, 23, 66,.5)",
                            pointHighlightStroke: "rgba(245, 23, 66,.5)",
                            data: [@foreach( $arr_revenue as $revenue )'{{$revenue}}', @endforeach]
                        },
                        {
                            label: "Total Price",
                            borderColor: "rgba(40, 169, 46, 0.9)",
                            borderWidth: "1",
                            backgroundColor: "rgba(40, 169, 46, .5)",
                            pointHighlightStroke: "rgba(40, 169, 46,.5)",
                            data: [@foreach( $arr_order as $order )'{{$order}}', @endforeach]
                        }
                        ]
                    },
                    options: {
                        responsive: true,
                        tooltips: {
                            mode: 'index',
                            intersect: false
                        },
                        hover: {
                            mode: 'nearest',
                            intersect: true
                        }

                    }
                } );
            }
    });
</script>
@endsection