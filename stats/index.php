<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    var device = '';
    var isMobile = {
        Android: function() {
            return navigator.userAgent.match(/Android/i);
        },
        BlackBerry: function() {
            return navigator.userAgent.match(/BlackBerry/i);
        },
        iOS: function() {
            return navigator.userAgent.match(/iPhone|iPad|iPod/i);
        },
        Opera: function() {
            return navigator.userAgent.match(/Opera Mini/i);
        },
        Windows: function() {
            return navigator.userAgent.match(/IEMobile/i) || navigator.userAgent.match(/WPDesktop/i);
        },
        any: function() {
            return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
        }
    };

    if (isMobile.any()) {
        if (isMobile.Android()) device = 'Android';
        if (isMobile.iOS()) device = 'iOS';
    } else {
        device = 'Desktop';
    }


    $.get("http://ipinfo.io", function(response) {
        $("#ip").html("IP: " + response.ip);
        $("#address").html("Location: " + response.city + ", " + response.region);
        $("#device").html("Device: " + device);
        $("#details").html(JSON.stringify(response, null, 4));
    }, "jsonp");
</script>
<bod>

    <!-- <h3>Client side IP geolocation using <a href="http://ipinfo.io">ipinfo.io</a></h3> -->

    <h3><?php

        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
            $url = "https://";
        else
            $url = "http://";
        // Append the host(domain name, ip) to the URL.   
        $url .= $_SERVER['HTTP_HOST'];

        // Append the requested resource location to the URL   
        $url .= $_SERVER['REQUEST_URI'];

        echo $url;;   ?>
    </h3>

    <hr />
    <div id="ip"></div>
    <div id="address"></div>
    <div id="device"></div>
    <hr />Full response:
    <pre id="details"></pre>

</bod>