<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">

    <style>

        .timerFontSize {
            font-weight: normal;
            letter-spacing: .125rem;
            text-transform: uppercase;
        }

    </style>
</head>
<body>

<main class="main-content-wrapper">
    <section class="app-header-wrapper">
        <section class="desktop-header-wrapper d-sm-none d-none d-md-none d-lg-block">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-2">
                        <div class="desktop-header-logo">
                            <div class="logo-wrapper">
                                <img src="{{asset('assets/imgs/desktop-logo.png')}}" class="img-fluid">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="header-tag-content-wrapper">
                            <div class="header-tag-stars star-content">
                                <img src="{{asset('assets/imgs/group-stars.png')}}">
                                <p class="mb-0 mt-1">{{$positions}}/{{$totalUsers}}</p>
                            </div>
                            <div class="header-tag-content text-center">
                                <p class="mb-0">Join our trading challenge and have a chance at winning valuable prizes!</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="trading-target-wrapper">
                            <div class="trading-target-content text-center">
                                <h4 class="mb-1" style="color: white;">Balance</h4>
                                <h2>$ {{ round($balance,2) ?? 0}}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="trading-close-wrapper">
                            <div class="trading-close-content text-center">
                                <div id="countdown">
                                    <h4 style="color: white;">
                                        <span id="hours"></span> : <span id="minutes"></span> : <span id="seconds"></span>
                                    </h4>
                                </div>
                                {{--<h2>01:08:55</h2>--}}
                                <p class="mb-0">Until Trading Closes</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1">
                        <div class="btn-group">
                            <button type="button" id="initials" class="NavLetters" data-bs-toggle="dropdown" aria-expanded="false">
                                Action md
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item"  href="{{route('trade_results')}}">Trades History</a>
                                </li>
                                <li>
                                    <a class="dropdown-item"  href="{{route('dashboard')}}">Dashboard</a>
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a class="dropdown-item" href="{{route('logout')}}" onclick="event.preventDefault();
                                            this.closest('form').submit();"><i class="ft-power"></i> Logout</a>
                                    </form>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <section class="mobile-header-wrapper d-sm-block d-block d-md-block d-lg-none">
            <div class="container">
                <div class="row align-items-center gx-2" >
                    <div class="col-3">
                        <div class="mobile-log-wrapper">
                            <div class="mobile-logo">
                                <img src="{{asset('assets/imgs/desktop-logo.png')}}" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="star-wrapper">
                            <div class="star-content text-center">
                                <img src="{{asset('assets/imgs/group-stars.png')}}" class="img-fluid">
                                <p class="mb-0 mt-1">{{$positions}}/{{$totalUsers}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="account-balacnce">
                            <div class="account-balacnce-content text-center">
                                <h4 class="mb-1">Balance</h4>
                                <p class="mb-0">$ {{ round($balance,2) ?? 0}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="btn-group">
                            <button type="button" id="initials2" class="NavLetters" data-bs-toggle="dropdown" aria-expanded="false">
                                Action md
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item"  href="{{route('trade_results')}}">Trades History</a>
                                </li>
                                <li>
                                    <a class="dropdown-item"  href="{{route('dashboard')}}">Dashboard</a>
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a class="dropdown-item" href="{{route('logout')}}" onclick="event.preventDefault();
                                            this.closest('form').submit();"><i class="ft-power"></i> Logout</a>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="remining-time-wrapper">
                <div class="remining-time-content">
                    <div id="countdown2" class="timerFontSize">
                        <h4 style="color: white;">
                            <span id="hours1"></span> : <span id="minutes1"></span> : <span id="seconds1"></span>
                        </h4>
                    </div>
                    <p>Until Trading Closes</p>
                </div>
            </div>
        </section>
    </section>

    <section class="trading-graph-wrapper">
        <div class="trading-graph-layout-wrapper">
            <div class="trading-graph-inner">
                <div id="chartcontainer"></div>
                {{--                    <div id="chartdiv"></div>--}}
            </div>
            <div class="mobile-footer-wrapper  d-lg-none d-block d-md-block d-sm-block">
                <div class="mobile-footer-content-wrapper">
                    @if(isset($activeTrade) && $activeTrade != null)
                        <div class="trading-rating-content text-center">
                            <h3 class="mb-1">$ {{round($activeTrade->active_rate->close_rate,2) ?? 0}}</h3>
                            <p class="mb-0">Crude Oil WTI
                                @if($activeTrade->trade_type =="Buy")
                                    @if(isset($profit_loss) && $profit_loss != null)
                                        @if($profit_loss < 0)

                                            <span class="lose">({{round($profit_loss,2)}})</span>
                                        @else
                                            <span class="profit">({{round($profit_loss,2)}})</span>
                                        @endif
                                    @endif
                                @endif
                                @if($activeTrade->trade_type =="Sell")
                                    @if(isset($profit_loss) && $profit_loss != null)
                                        @if($profit_loss < 0)
                                            <span class="profit">({{round($profit_loss,2)}})</span>
                                        @else
                                            <span class="lose">({{round($profit_loss,2)}})</span>
                                        @endif
                                    @endif
                                @endif
                            </p>
                        </div>
                    @endif
                    <div class="trading-btn-wrapper">
                        <div class="trading-btn-placeholder">
                            <ul>

                                @if (isset($activeTrade) && $activeTrade != null)
                                    @if($activeTrade->trade_type == "Buy")
                                        <li class="me-2"><a href="{{url('/close_trade')}}" class="btn-tradeer btn-sell"><img src="{{asset('assets/imgs/up-arrow.png')}}" class="me-3"> Close {{$activeTrade->trade_type ?? "Buy"}} Trade</a></li>
                                    @endif

                                    @if($activeTrade->trade_type == "Sell")
                                        <li><a href="{{url('/close_trade')}}" class="btn-tradeer btn-sell"><img src="{{asset('assets/imgs/down-arrow.png')}}" class="me-3"> Close {{$activeTrade->trade_type ?? "Sell"}} Trade</a></li>
                                    @endif
                                @else
                                    <li class="me-2"><a href="{{url('/start_buy_trade')}}" class="btn-tradeer btn-buy me-2"><img src="{{asset('assets/imgs/up-arrow.png')}}" class="me-3"> Buy </a></li>
                                    <li><a href="{{url('/start_sell_trade')}}" class="btn-tradeer btn-sell"><img src="{{asset('assets/imgs/down-arrow.png')}}" class="me-3"> Sell </a></li>
                                @endif

                                {{--<li class="me-2"><button class="btn-tradeer btn-buy"><img src="{{asset('assets/imgs/up-arrow.png')}}" class="me-3"> Buy</button></li>
                                <li><button class="btn-tradeer btn-sell"><img src="{{asset('assets/imgs/down-arrow.png')}}" class="me-3"> Sell</button></li>--}}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="buy-sell-btn-wrapper d-none d-sm-none d-md-none d-lg-block">
        <div class="buy-sell-content-wrapper">
            @if(isset($activeTrade) && $activeTrade != null)
                <div class="buy-sell-running-values d-sm-block d-block d-md-block text-center  d-lg-none">
                    <h2>$ {{round($activeTrade->active_rate->close_rate,2) ?? 0}}</h2>
                    <p>Crude Oil WTI
                        @if(isset($profit_loss) && $profit_loss != null)
                            @if($profit_loss < 0)
                                <span class="lose">({{round($profit_loss,2)}})</span>
                            @else
                                <span class="profit">({{round($profit_loss,2)}})</span>
                            @endif
                        @endif
                        {{--				<span class="lose">(-0.05%)</span>--}}
                    </p>
                </div>
            @endif
            <div class="buy-sell-action-btn">
                <ul>
                    @if (isset($activeTrade) && $activeTrade != null)
                        @if($activeTrade->trade_type == "Buy")
                            <li><a href="{{url('/close_trade')}}" class="buy-btn trade-btn"><img src="{{asset('assets/imgs/up-arrow.png')}}" class="me-3"> Close {{$activeTrade->trade_type ?? "Buy"}} Trade</a></li>
                        @endif

                        @if($activeTrade->trade_type == "Sell")
                            <li><a href="{{url('/close_trade')}}" class="sell-btn trade-btn"><img src="{{asset('assets/imgs/down-arrow.png')}}" class="me-3"> Close {{$activeTrade->trade_type ?? "Sell"}} Trade</a></li>
                        @endif
                    @else
                        <li><a href="{{url('/start_buy_trade')}}" class="buy-btn trade-btn me-2"><img src="{{asset('assets/imgs/up-arrow.png')}}" class="me-3"> Buy </a></li>
                        <li><a href="{{url('/start_sell_trade')}}" class="sell-btn trade-btn"><img src="{{asset('assets/imgs/down-arrow.png')}}" class="me-3"> Sell </a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>

</main>


<style type="text/css">
    #chartcontainer {
        height: 100%;
        min-width: 100%;
    }
</style>

<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
<!-- END PAGE LEVEL JS-->
<script src="{{asset('admin-assets/js/toastr.min.js')}}" type="text/javascript"></script>
<script>

    function successMsg(_msg) {
        window.toastr.success(_msg);
    }

    function errorMsg(_msg) {
        window.toastr.error(_msg);
    }

    function warningMsg(_msg) {
        window.toastr.warning(_msg);
    }

    @if(Session::has('success'))
    successMsg('{{Session::get("success")}}');
    @endif

    @if(Session::has('error'))
    errorMsg("{{Session::get('error')}}");
    @endif

</script>
{{--<script src="https://cdn.amcharts.com/lib/5/index.js"></script>--}}
{{--<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>--}}
{{--<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>--}}


<script src="https://code.highcharts.com/stock/highstock.js"></script>
<script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
<script src="https://code.highcharts.com/stock/modules/accessibility.js"></script>


<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    const ajaxTradeApiDataRoute = "{{ route('ajax_trade_api_data') }}";
    let chart; //
    (async () => {

        const response = await fetch(ajaxTradeApiDataRoute); // Replace with your Laravel endpoint
        const data = await response.json();
        console.log(data);

        /*// Function to fetch and update data
        const fetchDataAndUpdateChart = async () => {
            try {
                const response = await fetch(ajaxTradeApiDataRoute);
                const data = await response.json();

                // Update the series data in the chart
                chart.series[0].setData(data);

            } catch (error) {
                console.error('Error fetching data:', error);
            }
        };*/

        // Function to fetch and update data
        const fetchDataAndUpdateChart = async () => {
            try {
                const response = await fetch(ajaxTradeApiDataRoute);
                const data = await response.json();

                // Update the chart with new data
                chart.update({
                    series: [{
                        type: 'candlestick',
                        data: data,
                    }],
                });
                // Log the updated data
                console.log(data);

            } catch (error) {
                console.error('Error fetching data:', error);
            }
        };

        /*
        const data = await fetch(
             'https://demo-live-data.highcharts.com/aapl-ohlc.json'
            ).then(response => response.json());
        */
        console.log(data);
        chart = Highcharts.stockChart('chartcontainer', {
            chart: {
                backgroundColor: '#262626',
                borderWidth: 0,
                borderColor: 'darkgray',
                borderRadius: 0,
                contextMenu: false
            },
            rangeSelector: {
                enabled: false,
            },
            xAxis: {
                gridLineColor: 'red',
                title: {
                    style: {
                        color: '#fff'
                    }
                },
                labels: {
                    style: {
                        color: '#fff'
                    }
                },
                lineWidth: 1,
                lineColor: '#000',
            },
            yAxis: {

                title: {
                    style: {
                        color: '#fff'
                    }
                },
                labels: {
                    style: {
                        color: '#fff'
                    }
                },

                opposite: false,
            },
            tooltip: {
                trigger: 'click',
                backgroundColor: '#262626',
                borderColor: '#262626',
                borderWidth: 1,
                style: {
                    color: '#fff',
                    fontSize: '14px'
                },
                headerFormat: '<b>{point.key}</b><br/>',
                pointFormat: 'Open: {point.open}<br/>High: {point.high}<br/>Low: {point.low}<br/>Close: {point.close}<br/>'
            },
            plotOptions: {
                candlestick: {
                    color: 'red',
                    upColor: 'green',
                    lineColor: 'red',
                    upLineColor: 'green',
                    lineWidth: 1,
                }
            },
            navigator: {
                enabled: false
            },
            series: [{
                type: 'candlestick',
                data: data,
            }],
            legend: {
                enabled: false,
                align: 'right',
                layout: 'vertical',
                verticalAlign: 'middle',
                backgroundColor: 'rgba(255, 255, 255, 0.75)'
            },
            /*
            credits: {
                text: 'Developed By Cyber Advance Solutions',
                href: 'https://cyberasol.com/',
                position: {
                    align: 'right',
                    x: -10,
                    verticalAlign: 'bottom',
                    y: -5
                }
            },
            */
        });

        // Fetch and update data every 30 seconds
        //const refreshInterval = 30000; // 30 seconds in milliseconds

        setInterval(fetchDataAndUpdateChart, 30000);

        // Fetch and update data immediately
        fetchDataAndUpdateChart();

    })();

    const name = document.getElementById("initials");
    const words = name.textContent;
    const letters = words.split(" ");
    let initials = "";

    for (const word of letters) {
        if (word.length > 0) {
            initials += word.charAt(0);
        }
    }
    document.getElementById("initials").textContent = initials;


    const name2 = document.getElementById("initials2");
    const words2 = name2.textContent;
    const letters2 = words2.split(" ");
    let initials2 = "";

    for (const word2 of letters2) {
        if (word2.length > 0) {
            initials2 += word2.charAt(0);
        }
    }
    document.getElementById("initials2").textContent = initials2;

</script>

<script type="text/javascript">

    /*

    var chart; // Declare chart as a global variable

     // <!-- Chart code -->
     am5.ready(function() {
         var root = am5.Root.new("chartdiv");
         // Set themes
         // https://www.amcharts.com/docs/v5/concepts/themes/
         root.setThemes([am5themes_Animated.new(root)]);

         // Initial data for setup chart.
         function generateChartData() {

             var chartData = [];

{{--            @foreach($trade_rates as $key=> $trade)--}}
    {{--            //date: {{\Carbon\Carbon::now()->addMinute($key)->timestamp}} * 1000,--}}
    {{--chartData.push({--}}
    {{--    date: {{$trade['time_stamp']}} * 1000,--}}
    {{--    value: {{ $trade['close_rate']}},--}}
    {{--    open: {{$trade['open_rate']}},--}}
    {{--    low: {{$trade['low_rate']}},--}}
    {{--    high: {{$trade['high_rate']}}--}}
    {{--});--}}
    {{--            @endforeach--}}

    return chartData;
}

var initialData = generateChartData();

// Create the chart and assign it to the global variable chart
var chart = root.container.children.push(
    am5xy.XYChart.new(root, {
        focusable: true,
        panX: true,
        panY: true,
        wheelX: "panX",
        wheelY: "zoomX",
        pinchZoom: true,
        // zoomable:true,
    })
);

var xAxis = chart.xAxes.push(
    am5xy.DateAxis.new(root, {
        groupData: true,
        maxDeviation: 0.5,
        baseInterval: { timeUnit: "minute", count: 1 }, // Set to minute interval
        renderer: am5xy.AxisRendererX.new(root, { pan: "zoom" }),
        tooltip: am5.Tooltip.new(root, {})
    })
);

var yAxis = chart.yAxes.push(
    am5xy.ValueAxis.new(root, {
        maxDeviation:1,
        renderer: am5xy.AxisRendererY.new(root, {pan:"zoom"})
    })
);

var color = root.interfaceColors.get("background");


var series = chart.series.push(
    am5xy.CandlestickSeries.new(root, {
        fill: color,
        calculateAggregates: true,
        stroke: color,
        name: "MDXI",
        xAxis: xAxis,
        yAxis: yAxis,
        valueYField: "value",
        openValueYField: "open",
        lowValueYField: "low",
        highValueYField: "high",
        valueXField: "date",
        lowValueYGrouped: "low",
        highValueYGrouped: "high",
        openValueYGrouped: "open",
        valueYGrouped: "close",
        legendValueText:
            "open: {openValueY} low: {lowValueY} high: {highValueY} close: {valueY}",
        legendRangeValueText: "{valueYClose}",

    })
);

var cursor = chart.set(
    "cursor",
    am5xy.XYCursor.new(root, {
        xAxis: xAxis
    })
);
cursor.lineY.set("visible", false);

chart.leftAxesContainer.set("layout", root.verticalLayout);

var myTheme = am5.Theme.new(root);

myTheme.rule("AxisLabel").setAll({
  fill: am5.color(0xFFFFFF),
});

root.setThemes([
  myTheme
]);


// set data
series.data.setAll(initialData);
// sbseries.data.setAll(initialData);

series.appear(1000);
chart.appear(1000, 100);

// Fetch and update data at a specific interval (e.g., every 30 seconds)
setInterval(fetchDataAndUpdateChart, 30000); // 5000 milliseconds = 5 seconds , and 30000 = 30 seconds

// Define the fetchDataAndUpdateChart function
function fetchDataAndUpdateChart() {
    $.ajax({
        type: "POST",
        url: "{{url('ajax_trade_api_data')}}",
                data: {
                    //'id': id,
                    'csrf-token': "{{csrf_token()}}"
                },
                dataType: 'json',
                success: function (data) {
                    var chartAjaxData = [];

                    $.each(data, function(index, row) {
                        //alert(row);
                        //console.log(row.time_stamp);
                        chartAjaxData.push({
                            date: row.time_stamp * 1000,
                            value: row.close,
                            open: row.open,
                            low: row.low,
                            high: row.high
                        });
                    });

                    // Assuming that your API response returns data in the same format as your previous data
                    // Update the chart with the received data
                    series.data.setAll(chartAjaxData);
                },
                error: function (xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }
    });


*/



    // Function for Top Counter

    (function () {
        const second = 1000,
            minute = second * 60,
            hour = minute * 60;

        let today = new Date(),
            dd = String(today.getDate()).padStart(2, "0"),
            mm = String(today.getMonth() + 1).padStart(2, "0"),
            yyyy = today.getFullYear(),
            nextDay = new Date(today); // Create a new Date object for the next day
        nextDay.setDate(nextDay.getDate() + 1); // Set it to the next day

        // Set the start and end times (6 AM to 6 PM)
        let startTime = new Date(yyyy, mm - 1, dd, 6, 0, 0).getTime();
        let endTime = new Date(yyyy, mm - 1, dd, 18, 0, 0).getTime();

        // Check if the current time is past 6 PM, if so, set the start time for the next day
        if (today.getTime() >= endTime) {
            startTime = new Date(nextDay.getFullYear(), nextDay.getMonth(), nextDay.getDate(), 6, 0, 0).getTime();
            endTime = new Date(nextDay.getFullYear(), nextDay.getMonth(), nextDay.getDate(), 18, 0, 0).getTime();
        }

        const x = setInterval(function() {
            const now = new Date().getTime();

            if (now >= endTime) {
                // Time has passed 6 PM, set the start time for the next day
                startTime = new Date(nextDay.getFullYear(), nextDay.getMonth(), nextDay.getDate(), 6, 0, 0).getTime();
                endTime = new Date(nextDay.getFullYear(), nextDay.getMonth(), nextDay.getDate(), 18, 0, 0).getTime();
            }

            const distance = endTime - now;

            const hours = Math.floor(distance / hour);
            const minutes = Math.floor((distance % hour) / minute);
            const seconds = Math.floor((distance % minute) / second);

            document.getElementById("hours").innerText = hours;
            document.getElementById("minutes").innerText = minutes;
            document.getElementById("seconds").innerText = seconds;

            // Select elements by class name
            document.getElementById("hours1").innerText = hours;
            document.getElementById("minutes1").innerText = minutes;
            document.getElementById("seconds1").innerText = seconds;

            //do something later when time is reached
            if (distance <= 0) {
                // document.getElementById("headline").innerText = "It's 6 PM!";
                document.getElementById("countdown").style.display = "none";
                document.getElementById("countdown2").style.display = "none";
                //document.getElementById("content").style.display = "block";
                clearInterval(x);
            }
        }, 0);
    })();

    /*
    //var chartAjaxData = [];

    function fetchDataAndUpdateChart() {
        $.ajax({
            type: "POST",
            url: "{{url('ajax_trade_api_data')}}",
            data: {
                //'id': id,
                'csrf-token': "{{csrf_token()}}"
            },
            dataType: 'json',
            success: function (data) {


                    $.each(data, function(index, row) {
                        //alert(row);
                        //console.log(row.time_stamp);
                        chartAjaxData.push({
                            date: row.time_stamp * 1000,
                            value: row.close,
                            open: row.open,
                            low: row.low,
                            high: row.high
                        });
                    });

                    // Assuming that your API response returns data in the same format as your previous data
                    // Update the chart with the received data
                    //series.data.setAll(chartAjaxData);
            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
            }
        });
    }

    */



</script>
</body>
</html>
