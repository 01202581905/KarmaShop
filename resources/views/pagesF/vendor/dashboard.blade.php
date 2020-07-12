@extends('pagesF.vendor.master')
@section('title_vendor')
DashBoard | Vendor | COZA
@endsection
@section('vendor')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<div class="content">
            <!-- Animated -->
            <div class="animated fadeIn">
                <!-- Widgets  -->
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-1">
                                        <i class="pe-7s-cash"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text">$<span class="count">{{ $revenue[0]->totalprice*0.9 }}</span></div>
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
                                            <div class="stat-text"><span class="count">{{$orders }}</span></div>
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
                                        <i class="pe-7s-browser"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text"><span class="count">{{$products}}</span></div>
                                            <div class="stat-heading">Products</div>
                                        </div>
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
                                <h4 class="box-title">Traffic </h4>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card-body">
                                        <canvas id="TrafficChart"></canvas>  
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
                                                    <th>Product</th>
                                                    <th>Quantity</th>
                                                    <th>Size</th>
                                                    <th>Color</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach( $detail_order as $order )
                                                <tr>
                                                    <td class="serial">{{$order->id}}</td>
                                                    <td class="avatar">
                                                        <div class="round-img">
                                                            <a href="#"><img src="public/assetF/images/avatar/{{ $order->avatar }}" alt=""></a>
                                                        </div>
                                                    </td>
                                                    <td>  <span class="name">{{ $order->name_recipient }}</span> </td>
                                                    <td> <span class="product">{{ $order->name }}</span> </td>
                                                    <td><span class="count">{{ $order->quantity }}</span></td>
                                                    <td><span class="">{{ $order->size }}</span></td>
                                                    <td><span class="">{{ $order->color }}</span></td>
                                                    <td>
                                                        @if( $order->status == 0 && $order->cancel == 0 )
                                                        <span class="badge badge-pending">Pending</span>
                                                        @elseif( $order->status == 0 && $order->cancel == 1 )
                                                        <span class="badge badge-pending" style="background-color: #c82333;">Cancel</span>
                                                        @elseif( $order->status == 1 && $order->cancel == 0 )
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
                            data: [@foreach( $arr_order as $order )'{{$order}}', @endforeach]
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
                            data: [@foreach( $arr_totalprice as $price )'{{$price}}', @endforeach]
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