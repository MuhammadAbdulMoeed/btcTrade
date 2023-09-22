<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
	<title>Dashboard</title>
	<link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
    <link href="{{asset('admin-assets/css/toastr.css')}}" rel="stylesheet">
    <link rel="icon" href="{{asset('assets/imgs/fav.png')}}" />
    <link rel="apple-touch-icon" href="{{asset('assets/imgs/fav.png')}}" />
    <style>

        .timerFontSize {
            font-weight: normal;
            letter-spacing: .125rem;
            text-transform: uppercase;
        }

    </style>
</head>
<body>

	<main class="main-content-wrapper with-out-graph">
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
                                <button type="button" class="NavLetters" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{asset('assets/imgs/menu.png')}}" class="img-fluid">
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item"  href="{{route('trade_results')}}">Trades History</a>
                                    </li>
                                   {{-- <li>
                                        <a class="dropdown-item"  href="{{route('graph')}}">Graph Dashboard</a>
                                    </li>--}}
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
                                <button type="button" class="NavLetters" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{asset('assets/imgs/menu.png')}}" class="img-fluid">
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item"  href="{{route('trade_results')}}">Trades History</a>
                                    </li>
                                   {{-- <li>
                                        <a class="dropdown-item"  href="{{route('graph')}}">Graph Dashboard</a>
                                    </li>--}}
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

        <section class="trade-card-wrapper">
            <div class="trade-card-content-wrapper">
                <div class="trade-card-content w-100">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="balance-amount-wrapper">
                                    <div class="balance-amount-content">
                                        <div class="row">
                                            <div class="col-6">
                                                <h4>balance</h4>
                                            </div>
                                            <div class="col-6 text-end">
                                                <p><sup>$</sup>{{ round($balance,2) ?? 0}}</p>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="trader-card">
                                    <div class="row mb-3">
                                        <div class="col-6">
                                            <div class="trade-result">
                                                <h2>Current Rate</h2>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="trade-amount text-end">
                                                <h4><sup>$</sup> <span id="current_rate">{{ round($trade_rates->close_rate,2) ?? 0}} </span>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-6">
                                            <div class="trade-result">
                                                <h2>Your Trade</h2>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="trade-amount ">
                                                <h4><sup>$</sup>
                                                    @if(isset($activeTrade))
                                                        <span id="trade-rate">{{round($activeTrade->active_rate->close_rate,2) ?? 0}}</span>
                                                    @else
                                                        <span id="trade-rate">0.00</span>
                                                    @endif
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">

                                        @if(isset($activeTrade) && $activeTrade != null)

                                        <div class="col-12 mb-4 mb-sm-4 mb-md-4 mb-lg-4">
                                            <div class="trade-result">
                                                <h2>BTC
                                                @if(isset($activeTrade) && $activeTrade != null)
                                                    @if($activeTrade->trade_type =="Buy")
{{--                                                        @if(isset($profit_loss) && $profit_loss != null)--}}
                                                            @if($profit_loss < 0)
                                                                <span id="buy_lose" class="lose profitval">({{$profit_loss_positive ?? 0}})</span>
                                                            @else
                                                                <span id="buy_profit" class="profit profitval">({{$profit_loss_positive ?? 0}})</span>
                                                            @endif
{{--                                                        @endif--}}

                                                    @elseif ($activeTrade->trade_type =="Sell")

{{--                                                        @if(isset($profit_loss) && $profit_loss != null)--}}

                                                            @if($profit_loss < 0)
                                                                <span id="sell_profit" class="profit profitval">({{$profit_loss_positive ?? 0}})</span>
                                                            @else
                                                                <span id="sell_lose" class="lose profitval">({{$profit_loss_positive ?? 0}})</span>
                                                            @endif
{{--                                                        @endif--}}
                                                    @else
                                                     <span id="buy_profit" class="profit profitval">(0)</span>
                                                    @endif

                                               @endif

                                                </h2>
                                            </div>
                                        </div>

{{--                                        <div class="col-6 mb-0 mb-sm-0 mb-md-0 mb-lg-4">--}}
{{--                                            <div class="trade-amount ">--}}
{{--                                                <h4><sup>$</sup>--}}
{{--                                                    @if(isset($activeTrade))--}}
{{--                                                        <span id="trade-rate">{{round($activeTrade->active_rate->close_rate,2) ?? 0}}</span>--}}
{{--                                                    @else--}}
{{--                                                        <span id="trade-rate">0.00</span>--}}
{{--                                                    @endif--}}
{{--                                                </h4>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                        @endif
                                        <div class="col-lg-12 order-2 order-sm-2 order-md-2 order-lg-2">
                                            <div class="trader-btn-no-graph">
                                                <div class="row">

                                                    @if(isset($activeTrade) && $activeTrade != null)
                                                        <div class="col-12 mt-3">
                                                            <div>
                                                                @if($activeTrade->trade_type == "Buy")
                                                                      <a href="{{url('/close_trade')}}" class="btn-tradeer btn-close-trade-buy text-center">Close {{$activeTrade->trade_type ?? "Buy"}} Trade</a>
                                                                @elseif($activeTrade->trade_type == "Sell")
                                                                      <a href="{{url('/close_trade')}}" class="btn-tradeer btn-close-trade-sell text-center">Close {{$activeTrade->trade_type ?? "Sell"}} Trade</a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="col-6">
                                                            <div>
                                                                <a href="{{url('/start_buy_trade')}}" class="btn-tradeer btn-buy text-center"><img src="{{asset('assets/imgs/up-arrow.png')}}" class="me-3">Buy</a>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div>
                                                                <a href="{{url('/start_sell_trade')}}" class="btn-tradeer btn-sell text-center"><img src="{{asset('assets/imgs/down-arrow.png')}}" class="me-3">Sell</a>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <style type="text/css">
        .with-out-graph .app-header-wrapper{
            flex: 0 0 125px ;
        }
        .trade-card-wrapper{
            flex-grow: 1;
        }
        .trade-card-content-wrapper{
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            width: 100%;
        }
        .trader-card{
            background: #1B1B1B;
            padding: 10px;
            width: 100%;
            border-bottom: 3px solid #B09020;
        }
        .trade-result{
            padding: 5px;
        }
        .trade-result h2 span.lose{
            font-family: 'Inter', sans-serif;
            font-weight: 300;
            color: red;
            margin: 0px;
            font-size: 14px;
        }
        .trade-result h2 span.profit{
             font-family: 'Inter', sans-serif;
            font-weight: 300;
            color: green;
            margin: 0px;
            font-size: 14px;
        }
        .trade-amount h4{
            color: #fff;
            font-family: 'Inter', sans-serif;
            font-weight: 500;
            text-align: right;
            padding: 5px;
             font-size: 30px;
             margin-bottom: 0px;
            word-break: break-all;
            white-space:unset !important;
        }
        .trade-amount h4 sup{
            color: green;
        }
        .trade-result h2{
            color: #fff;
            font-size: 30px;
            font-weight: 200;
            margin-bottom: 0px;
            font-family: 'Inter', sans-serif;
        }
        .trader-btn-no-graph{
            padding: 5px;
        }
        .balance-amount-content{
            background: #1B1B1B;
            padding: 10px;
            width: 100%;
            border-bottom: 3px solid #B09020;
            margin-bottom: 10px;
        }
        .balance-amount-content h4{
            text-transform: uppercase;
            color: #fff;
            font-weight: 700;
            font-family: 'Inter', sans-serif;
        }
        .balance-amount-content p{
            color: #fff;
            margin-bottom: 0px;
            font-size: 20px;
            font-weight: 500;
            word-break: break-all;
        }
        .balance-amount-content p sup{
            color: green;
            margin-right: 5px;
        }
        .btn-tradeer.btn-close{
            background: blue;
            border-bottom: 3px solid blue;
        }
        .btn-tradeer.btn-close-trade-buy{
            background: #054214;
            border-bottom: 3px solid #054214;
        }.btn-tradeer.btn-close-trade-sell{
             background: #4A0808;
             border-bottom: 3px solid #4A0808;
         }
        @media(min-width:320px) and (max-width:767px){
            /*.trade-amount h4{*/
            /*    text-align: left;*/
            /*}*/
            .trade-result h2{
                font-size: 20px;
            }
            .trade-amount h4{
                font-size: 26px;
                font-weight: 700;
            }
        }

    </style>


<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>


    <script type="text/javascript">

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.btn-tradeer').click(function(event) {
                //alert("Button Clicked");
            $.blockUI({
                css: {
                    border: 'none',
                    padding: '15px',
                    backgroundColor: '#000',
                    '-webkit-border-radius': '10px',
                    '-moz-border-radius': '10px',
                    opacity: .5,
                    color: '#fff'
                }
            });
        });


        function refreshRate() {

            $.ajax({

                url: "{{ route('refresh_rate.data') }}",

                method: "GET",
                success: function(response) {
                    //alert(response.close_rate);
                    // Update the content of the data container with the new data
                    $('#current_rate').html(response.close_rate);

                    if(response.profit_loss != "")
                    {
                        var profitLoss = response.profit_loss;
                        // $('.profitval').html(response.close_rate);
                        console.log(profitLoss);
                        if(response.trade_type == "Buy" && profitLoss < 0) {
                            var positiveValue = response.profit_loss_positive;
                            $('#buy_lose').html('('+positiveValue+')');
                        } else if(response.trade_type == "Buy" && profitLoss >= 0) {
                            var positiveValue = response.profit_loss_positive;
                            $('#buy_profit').html('('+positiveValue+')');
                        } else if(response.trade_type == "Sell" && profitLoss < 0) {
                            var positiveValue = response.profit_loss_positive;
                            $('#sell_profit').html('('+positiveValue+')');
                        } else if(response.trade_type == "Sell" && profitLoss >= 0) {
                            var positiveValue = response.profit_loss_positive;
                            $('#sell_lose').html('('+positiveValue+')');
                        }
                    }
                }
            });
        }
        // Refresh data every 5 seconds
        setInterval(refreshRate, 10000);
        // Initial data load
        refreshRate();


        /*

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


        */

    </script>

    @include('customer.js')

</script>
</body>
</html>
