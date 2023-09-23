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

    // const name = document.getElementById("initials");
    // const words = name.textContent;
    // const letters = words.split(" ");
    // let initials = "";

    // for (const word of letters) {
    //     if (word.length > 0) {
    //         initials += word.charAt(0);
    //     }
    // }

    // document.getElementById("initials").textContent = initials;

    // const name2 = document.getElementById("initials2");
    // const words2 = name2.textContent;
    // const letters2 = words2.split(" ");
    // let initials2 = "";

    // for (const word2 of letters2) {
    //     if (word2.length > 0) {
    //         initials2 += word2.charAt(0);
    //     }
    // }
    // document.getElementById("initials2").textContent = initials2;


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

// Calculate the start time as the current time
         let startTime = today.getTime();

// Calculate the end time as 4 hours from now
         let endTime = new Date(today.getTime() + 4 * hour + 5 * minute).getTime();

// Check if the current time is past the calculated end time, if so, set it for the next day
         if (today.getTime() >= endTime) {
             startTime = new Date(nextDay.getFullYear(), nextDay.getMonth(), nextDay.getDate(), 0, 0, 0).getTime();
             endTime = new Date(nextDay.getTime() + 4 * hour + 5 * minute).getTime();
         }

         const x = setInterval(function() {
             const now = new Date().getTime();

             if (now >= endTime) {
                 // Time has passed the calculated end time, set it for the next day
                 startTime = new Date(nextDay.getFullYear(), nextDay.getMonth(), nextDay.getDate(), 0, 0, 0).getTime();
                 endTime = new Date(nextDay.getTime() + 4 * hour + 5 * minute).getTime();
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

    */

</script>
