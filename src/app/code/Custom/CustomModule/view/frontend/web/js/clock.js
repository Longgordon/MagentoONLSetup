require(["jquery"], function ($) {
    $(document).ready(function () {
        (function createSecondLines() {
            var $clock = $(".clock");
            var rotate = 0;

            var byFive = function (n) {
                return n / 5 === parseInt(n / 5, 10) ? true : false;
            };

            for (var i = 0; i < 30; i++) {
                var $span = $("<span></span>");

                if (byFive(i)) {
                    $span.addClass("fives");
                }

                $span.css(
                    "transform",
                    "translate(-50%,-50%) rotate(" + rotate + "deg)"
                );
                $clock.append($span);
                rotate += 6;
            }
        })();

        (function setClock() {
            var time = new Date();

            var hours = time.getHours();
            var minutes = time.getMinutes();
            var seconds = time.getSeconds();

            var $clock = {
                hours: $(".hours"),
                minutes: $(".minutes"),
                seconds: $(".seconds"),
            };

            var deg = {
                hours: 30 * hours + 0.5 * minutes,
                minutes: 6 * minutes + 0.1 * seconds,
                seconds: 6 * seconds,
            };

            $clock.hours.css("transform", "rotate(" + deg.hours + "deg)");
            $clock.minutes.css("transform", "rotate(" + deg.minutes + "deg)");
            $clock.seconds.css("transform", "rotate(" + deg.seconds + "deg)");

            var runClock = function () {
                deg.hours += 360 / 43200;
                deg.minutes += 360 / 3600;
                deg.seconds += 360 / 60;

                $clock.hours.css("transform", "rotate(" + deg.hours + "deg)");
                $clock.minutes.css(
                    "transform",
                    "rotate(" + deg.minutes + "deg)"
                );
                $clock.seconds.css(
                    "transform",
                    "rotate(" + deg.seconds + "deg)"
                );
            };

            setInterval(runClock, 1000);

            (function printDate() {
                var months = [
                    "01",
                    "02",
                    "03",
                    "04",
                    "05",
                    "06",
                    "07",
                    "08",
                    "09",
                    "10",
                    "11",
                    "12",
                ];
                var print = time.getDate() + " / " + months[time.getMonth()];
                var $output = $("output");

                $output.each(function () {
                    $(this).html(print);
                });
            })();
        })();
    });
});
