<?php
class IPgetter{
    public function getVisIpAddr() {
        
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        }
        else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else {
            return $_SERVER['REMOTE_ADDR'];
        }
    }
}
// $ipgtter = new IPgetter();
// $ip = $ipgtter->getVisIpAddr();
// // Use JSON encoded string and converts
// // it into a PHP variable
// $ipdat = file_get_contents("http://www.geoplugin.net/json.gp?ip=");
// $dataGet = Json_decode($ipdat);
// echo 'Country Name: ' . $dataGet->geoplugin_countryName . "\n";
// echo 'City Name: ' . $dataGet->geoplugin_city . "\n";
// echo 'Continent Name: ' . $dataGet->geoplugin_continentName . "\n";
// echo 'Latitude: ' . $dataGet->geoplugin_latitude . "\n";
// echo 'Longitude: ' . $dataGet->geoplugin_longitude . "\n";
// echo 'Currency Symbol: ' . $dataGet->geoplugin_currencySymbol . "\n";
// echo 'Currency Code: ' . $dataGet->geoplugin_currencyCode . "\n";
// echo 'Timezone: ' . $dataGet->geoplugin_timezone;
?>