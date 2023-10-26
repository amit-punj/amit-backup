<?php 
return array(
/** set your paypal credential **/
// 'client_id' =>'ASpT4kv2bKn5TbjpB-gonsaD2DiNbon2zVZXPZljKvaJBhlrJWmoWDMCKqIStnK0kDARKHpci0MrQy--',
// 'secret' => 'EFzE1E3wX7sqXa4KeEGMco5zneEVZJRip1nha1QDGjpPjzIXrrcvHoI6-UsYJbOo7ldYih7WJWyN-3XR',
'client_id' =>'ASkKmYLVaJ-SV_HJAJbFJ5paGnjmgY9O8H3bGaUlV7P_t5kFPodqykiiancohNfTBRm-jeX-eJpLxNuC',
'secret' => 'ECDkr6rq0xUpIqJ0aMXtQ_1lEttHKbA-C8QRusWs28yeAEaJ355ENaN2mUu2FGQffMubzFrWDmd6lQ6H',
/**
* SDK configuration 
*/
'settings' => array(
/**
* Available option 'sandbox' or 'live'
*/
'mode' => 'sandbox',
/**
* Specify the max request time in seconds
*/
'http.ConnectionTimeOut' => 1000,
/**
* Whether want to log to a file
*/
'log.LogEnabled' => true,
/**
* Specify the file that want to write on
*/
'log.FileName' => storage_path() . '/logs/paypal.log',
/**
* Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
*
* Logging is most verbose in the 'FINE' level and decreases as you
* proceed towards ERROR
*/
'log.LogLevel' => 'FINE'
),
);
