@extends('pagesB.master')
@section('title_admin')
Manager Chart Revenue | Admin | COZA
@endsection
@section('contentserver')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<div class="content">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-3">Orders</h4>
                                <canvas id="sales-chart"></canvas>
                            </div>
                        </div>
                    </div><!-- /# column -->

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-3">Revenue</h4>
                                <canvas id="team-chart"></canvas>
                            </div>
                        </div>
                    </div><!-- /# column -->

                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-3">Product Sellings</h4>
                                <canvas id="barChart"></canvas>
                            </div>
                        </div>
                    </div><!-- /# column -->
                </div>

            </div><!-- .animated -->
        </div>
<script type="text/javascript">
    jQuery(document).ready(function($){
        if ($('#sales-chart').length) {
            var ctx = document.getElementById( "sales-chart" );
            ctx.height = 150;
            var myChart = new Chart( ctx, {
                type: 'line',
                data: {
                    labels: [@foreach( $arr_month as $month )'{{$month}}', @endforeach],
                    datasets: [
                    {
                        label: "Order",
                        borderColor: "rgba(4, 73, 203)",
                        borderWidth: "3",
                        backgroundColor: "rgba(0, 0, 0, 0.0)",
                        data: [@foreach( $arr_countorder as $order )'{{$order}}', @endforeach]
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
                    },
                }
            } );
        }


        if ($('#team-chart').length) {
            var ctx = document.getElementById( "team-chart" );
            ctx.height = 150;
            var myChart = new Chart( ctx, {
                type: 'line',
                data: {
                    labels: [@foreach( $arr_month as $month )'{{$month}}', @endforeach],
                    datasets: [
                    {
                        label: "Revuene",
                        borderColor: "rgba(4, 73, 203,0.5)",
                        borderWidth: "1",
                        backgroundColor: "rgba(245, 23, 66,.5)",
                        pointHighlightStroke: "rgba(245, 23, 66,.5)",
                        data: [@foreach( $arr_revenue as $revenue )'{{$revenue}}', @endforeach]
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
                    },
                }
            } );
        }

        if ($('#barChart').length) {
            var ctx = document.getElementById( "barChart" );
            ctx.height = 250;
            var myChart = new Chart( ctx, {
                type: 'pie',
                data: {
                    labels: [@foreach( $arr_product as $product )'{{$product}}', @endforeach],
                    datasets: [
                    {
                        label: "Count",
                        borderColor: "rgba(4, 73, 203,0.5)",
                        borderWidth: "0",
                        backgroundColor: "#7fe0c8",
                        pointHighlightStroke: "rgba(245, 23, 66,0.5)",
                        data: [@foreach( $arr_count as $count )'{{$count}}', @endforeach]
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
                    },
                }
            } );
        }
    });
</script>
@endsection