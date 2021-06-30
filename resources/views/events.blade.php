<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            background-color: #DEDEDE;
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }

        .paper {
            border-radius: 5px;
            background-color: white;
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            padding-bottom: 15px;
        }

        .page-title {
            width: 100%;
            border-bottom: 1px solid #a9a9a9;
            text-align: start;
        }

        .page-title h2 {
            font-weight: 600;
            font-size: 1rem;
            margin-left: 10px;
        }

        .setup {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
        }

        .page-body {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: initial;
            padding-top: 20px;
            width: 100%;
        }

        .page-body .setup {
            width: 30%;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
        }

        .page-body .setup .event,
        .page-body .setup .date-range,
        .page-body .setup .repeat,
        .page-body .setup .submit {
            display: flex;
            flex-direction: row;
            justify-content: flex-start;
            align-items: center;
            padding-left: 10px;
            width: 100%;
        }

        .input-container {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            margin-right: 35px;
            width: 100%;
        }

        .input-container h1 {
            font-weight: 500;
            font-size: .8rem;
        }

        .input-container input[type='text'] {
            font-weight: 400;
            font-size: .8rem;
            height: 15px;
            width: 100%;
            padding: 5px;
            border-radius: 3px;
            border: 1px solid;
        }

        .page-body .setup .event input[type='text'] {
            width: 100% !important;
        }

        .page-body .calendar {
            width: 70%;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            padding-right: 15px;
        }

        .page-body .setup .repeat .repeat-date {
            display: flex;
            flex-direction: row;
            justify-content: flex-start;
            align-items: center;
            margin-right: 5px;
        }

        .page-body .setup .repeat .repeat-date p {
            font-weight: 400;
            font-size: .7rem;
        }

        .page-body .setup .repeat .repeat-date input {
            cursor: pointer;
        }

        .button {
            padding: 5px 10px;
            background-color: #299FFF;
            color: white;
            font-weight: 400;
            font-size: .8rem;
            letter-spacing: 3px;
            border-radius: 5px;
            cursor: pointer;
            width: 40px;
            text-align: -webkit-center;
        }

        .button:hover {
            background-color: white;
            border: 1px solid #299FFF;
            color: #299FFF;
        }

        .page-body .calendar .calendar-title {
            font-weight: 600;
            font-size: 2rem;
            width: 100%;
            border-bottom: 1px solid #a9a9a9;
            padding-bottom: 7px;
        }

        .page-body .calendar .dates {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            width: 100%;
            overflow: hidden;
        }

        .page-body .calendar .dates .days {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: flex-start;
            width: 100%;
            padding-left: 7px;
            padding-top: 8px;
            padding-bottom: 8px;
            border-bottom: 1px solid #a9a9a9;
        }

        .page-body .calendar .dates .days .mark {
            width: 10%;
        }

        .page-body .calendar .dates .days .event {
            width: 90%;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .page-body .calendar .dates .days .mark,
        .page-body .calendar .dates .days .event {
            font-weight: 400;
            font-size: .8rem;
        }

        .has-events {
            background-color: #C4FFC4;
        }

        /* Loading button */
        .loader {
            border: 2px solid #f3f3f3;
            border-radius: 50%;
            border-top: 2px solid #3498db;
            width: 12px;
            height: 12px;
            -webkit-animation: spin 2s linear infinite;
            /* Safari */
            animation: spin 2s linear infinite;
        }

        /* Safari */
        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Toast CSS */

        #toasts {
            min-height: 0;
            position: fixed;
            right: 20px;
            top: 20px;
            width: 400px;
        }

        #toasts .toast {
            background: #d6d8d9;
            border-radius: 3px;
            box-shadow: 2px 2px 3px rgba(0, 0, 0, .1);
            color: rgba(0, 0, 0, .6);
            cursor: default;
            margin-bottom: 20px;
            opacity: 0;
            position: relative;
            padding: 1px 5px;
            transform: translateY(15%);
            transition: opacity .5s ease-in-out, transform .5s ease-in-out;
            width: 100%;
            will-change: opacity, transform;
            z-index: 1100;
        }

        #toasts .toast.success {
            background: rgba(114, 179, 114, 0.8);
            color: #FFFFFF;
        }

        #toasts .toast.warning {
            background: #ffa533;
        }

        #toasts .toast.info {
            background: #2cbcff;
        }

        #toasts .toast.error {
            background: rgba(244, 67, 54, 0.8);
            color: #FFFFFF;
        }

        #toasts .toast.show {
            opacity: 1;
            transform: translateY(0);
            transition: opacity .5s ease-in-out, transform .5s ease-in-out;
        }

        #toasts .toast.hide {
            height: 0;
            margin: 0;
            opacity: 0;
            overflow: hidden;
            padding: 0 30px;
            transition: all .5s ease-in-out;
        }

        #toasts .toast .close {
            cursor: pointer;
            font-size: 15px;
            height: 16px;
            margin-top: -20px;
            position: absolute;
            right: 9px;
            top: 50%;
            width: 16px;
        }
    </style>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<body>

    <div class="paper">
        <div id="toasts"></div>
        <div class="page-title">
            <h2>Calendar</h2>
        </div>

        <div class="page-body">

            <div class="setup">
                <div class="event">
                    <div class="input-container">
                        <h1>Event</h1>
                        <input type="text" placeholder="Event" tabindex="1" id="event-name" class="event-name">
                    </div>
                </div>


                <div class="date-range">
                    <div class="input-container">
                        <h1>From</h1>
                        <input type="text" tabindex="1" id="from-date" class="from-date">
                    </div>
                    <div class="input-container">
                        <h1>To</h1>
                        <input type="text" tabindex="1" id="to-date" class="to-date">
                    </div>
                </div>

                <div class="repeat">
                    <div class="repeat-date">
                        <input type="checkbox" value="Monday" class="repeat-box">
                        <p>Mon</p>
                    </div>
                    <div class="repeat-date">
                        <input type="checkbox" value="Tuesday" class="repeat-box">
                        <p>Tue</p>
                    </div>
                    <div class="repeat-date">
                        <input type="checkbox" value="Wednesday" class="repeat-box">
                        <p>Wed</p>
                    </div>
                    <div class="repeat-date">
                        <input type="checkbox" value="Thursday" class="repeat-box">
                        <p>Thu</p>
                    </div>
                    <div class="repeat-date">
                        <input type="checkbox" value="Friday" class="repeat-box">
                        <p>Fri</p>
                    </div>
                    <div class="repeat-date">
                        <input type="checkbox" value="Saturday" class="repeat-box">
                        <p>Sat</p>
                    </div>
                    <div class="repeat-date">
                        <input type="checkbox" value="Sunday" class="repeat-box">
                        <p>Sun</p>
                    </div>
                </div>

                <div class="submit">
                    <div class="button" id="submit-btn" onClick="createEvents()">
                        Save
                    </div>
                    <div class="button" id="loading-btn">
                        <div class="loader"></div>
                    </div>
                </div>

            </div>

            <div class="calendar">

                <div class="calendar-title" id="calendar-title">
                    July 2021
                </div>
                <div class="dates" id="dates">

                </div>

            </div>

        </div>

    </div>



    <script type="text/javascript">
        var startDate = "<?php echo $start_date; ?>";
        var endDate = "<?php echo $end_date; ?>";
        var calendarTitle = "<?php echo $month . ' ' . $year; ?>";
        var dates = JSON.parse('<?php echo json_encode($dates); ?>');

        $(function () {

            $("#loading-btn").hide();
            $('#from-date').datepicker();
            $('#to-date').datepicker();
            $("#calendar-title").text(calendarTitle);

            var defaultConfig = {
                type: '',
                autoDismiss: true,
                container: '#toasts',
                autoDismissDelay: 4000,
                transitionDuration: 300
            };

            $.toast = function (config) {
                var size = arguments.length;
                var isString = typeof (config) === 'string';

                if (isString && size === 1) {
                    config = {
                        message: config
                    };
                }

                if (isString && size === 2) {
                    config = {
                        message: arguments[1],
                        type: arguments[0]
                    };
                }

                return new toast(config);
            };

            var toast = function (config) {
                config = $.extend({}, defaultConfig, config);
                // show "x" or not
                var close = config.autoDismiss ? '' : '&times;';

                // toast template
                var toast = $([
                    '<div class="toast ' + config.type + '">',
                    '<p>' + config.message + '</p>',
                    '<div class="close">' + close + '</div>',
                    '</div>'
                ].join(''));

                // handle dismiss
                toast.find('.close').on('click', function () {
                    var toast = $(this).parent();

                    toast.addClass('hide');

                    setTimeout(function () {
                        toast.remove();
                    }, config.transitionDuration);
                });

                // append toast to toasts container
                $(config.container).append(toast);

                // transition in
                setTimeout(function () {
                    toast.addClass('show');
                }, config.transitionDuration);

                // if auto-dismiss, start counting
                if (config.autoDismiss) {
                    setTimeout(function () {
                        toast.find('.close').click();
                    }, config.autoDismissDelay);
                }

                return this;
            };

            var events = [];
           
            requestEvents(startDate, endDate);

        });

        function requestEvents(startDate, endDate) {
            $("#submit-btn").hide();
            $("#loading-btn").show();
            $.ajax({

                url: "/api/events/" + startDate + "/" + endDate,
                method: "GET",
                success: function (data) {

                    updateEvents(data.events)

                }, error: function (data) {
                    alert(data);
                }

            });

        }

        function updateEvents(events) {
            $("#dates").html("");
            dates.forEach(date => {

                let currDate = date.date.split("-");
                currDate = currDate[2];

                let divDay = document.createElement("div");
                $(divDay).addClass("days");

                let divMark = document.createElement("div");
                $(divMark).addClass("mark");
                $(divMark).text(currDate + " " + date.l.substr(0, 3));
                divDay.append(divMark);

                let divEvent = document.createElement("div");
                $(divEvent).addClass("event");

                let details = [];
                events.forEach(event => {
                    if (event.scheduled_date === date.date) {
                        details.push(event.name);
                    }
                });

                $(divEvent).text(details.join(", "));
                divDay.append(divEvent);

                if (details.length > 0) {
                    $(divDay).addClass("has-events");
                }

                $("#dates").append(divDay);
            });

            $("#submit-btn").show();
            $("#loading-btn").hide();
        }

        function createEvents() {


            var name = $("#event-name").val();
            var fromDate = $("#from-date").val();
            var toDate = $("#to-date").val();
            var repeat = [];

            $(".repeat-box").each(function () {

                if (this.checked) {
                    repeat.push($(this).val());
                }

            });

            var valid = validateInput(name, fromDate, toDate, repeat);

            if (!valid) {
                alert("All fields are required.");
            }
            else {
                var params = {
                    "name": name,
                    "start_date": fromDate,
                    "end_date": toDate,
                    "repeat": repeat
                };
                $("#submit-btn").hide();
                $("#loading-btn").show();
                $.ajax({

                    url: "/api/events",
                    method: "POST",
                    data: params,
                    success: function (data) {
                        $.toast('success', 'Successfully saved!');

                        requestEvents(startDate, endDate);

                    }, error: function (data) {
                        $.toast('error', 'Failed!');
                        $("#submit-btn").show();
                        $("#loading-btn").hide();
                    }

                });

            }

        }

        function validateInput(name, fromDate, toDate, repeat) {
            if ($.trim(name) === "" ||
                $.trim(fromDate) === "" ||
                $.trim(toDate) === "" ||
                repeat.length === 0) {
                return false;
            }
            return true;
        }
    </script>
</body>