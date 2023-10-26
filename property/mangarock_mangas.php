<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.mangarockhd.com/query/web401/mrs_filter?country=India",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\"status\":\"all\",\"genres\":{},\"rank\":\"all\",\"order\":\"rank\"}",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "content-type: application/json",
    "postman-token: 5a4c528b-24a4-1f8e-d07e-9f24fbcdde21"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
   $data = json_decode($response)->data;
}


$servername = "localhost";
$username = "root";
$password = "123456";
$dbname = "sftpuser_manga_new";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

 foreach ($data as $key => $value) {     
 
    $sql = "INSERT INTO `mangarock_manga_ids` (`manga_id`) VALUES ('$value')";
            
    if ($conn->query($sql) === TRUE) {
        // echo $id = mysqli_insert_id($conn);
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        
    }

 }