<html>

<head>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAxX3JnyJbkZMQyklxtsznC6Q983K_rWp4&libraries=places">
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">
    <script>
    function initialize() {
        var input = document.getElementById('to');
        new google.maps.places.Autocomplete(input);
    }

    google.maps.event.addDomListener(window, 'load', initialize);
    </script>
    <style>
    .textbox {
        border-radius: 25px;
        font-family: Source Sans Pro, sans-serif;
        width:500px;
        height:50px;
        font-size:14px;
        border-color: #83c127;
        border-style: solid;
    }
    .button{
         font-family: Source Sans Pro, sans-serif;
         border-radius: 25px;
         border-style: solid;
         background-color: #83c127;
         border-color:#83c127;
         height:50px;
    }
    </style>
</head>

<body>
        <form method="post">
            <input type="text" name="to" id="to" class="textbox"/>
            <button type="submit" name="submit" id="SubmitFormData" class="button">Check</button>
        </form>
</body>

</html>
<?php
$addressFrom = '15 Hawkins Road Morganville NJ 07751';
$addressTo   = $_POST['to'];
$formattedAddrFrom    = str_replace(' ', '+', $addressFrom);
$formattedAddrTo     = str_replace(' ', '+', $addressTo);
$apiKey = 'GOOGLEMAPSAPIKEY';
$distance =     file_get_contents('https://maps.googleapis.com/maps/api/distancematrix/json?origins='.$formattedAddrFrom.'&destinations='.$formattedAddrTo.'&units=imperial&key='.$apiKey);
$obj = json_decode($distance, true);
$del = $obj['rows'][0]['elements'][0]['distance']['text'];
//$del = str_replace('mi', '', $del);
if ($del <= '5') {
    echo '<div style="font-family: Source Sans Pro, sans-serif;">Delivery is available! Please note for your selcted zone we have a $75 order minimum</div>';
 }  elseif ($del <= '10') {
    echo '<div style="font-family: Source Sans Pro, sans-serif;">Delivery is available! Please note for your selcted zone we have a $100 order minimum</div>';
 } elseif ($del <= '15') {
    echo '<div style="font-family: Source Sans Pro, sans-serif;">Delivery is available! Please note for your selcted zone we have a $100 order minimum and a $10 Delivery Fee</div>';
} elseif ($del <= '25') {
    echo '<div style="font-family: Source Sans Pro, sans-serif;">Delivery is available! Please note for your selcted zone we have a $125 order minimum and a $10 Delivery Fee</div>';
 } else {
    echo '<div style="font-family: Source Sans Pro, sans-serif;">Please Call Us <a href="tel:732679x3100">(732) 679-3100</a> at to place your order</div>';
}
?>