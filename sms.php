<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="sms.php" method="post">
        <input type="text" name="number" placeholder="enter number"/>
        <input type="text" name="text" placeholder="enter message"/>
        <input type="submit" value="send" name="submit">
    </form>
</body>
</html>
<?php
if(isset($_POST['submit'])){
    $number=$_POST['number'];
    $text=$_POST['text'];

$url="www.way2sms.com/api/v1/sendCampaign";
$message = urlencode($text);// urlencode your message
$curl = curl_init();
curl_setopt($curl, CURLOPT_POST, 1);// set post data to true
curl_setopt($curl, CURLOPT_POSTFIELDS, "apikey=PateAPI&secret=PasteSecretCode&usetype=stage&phone=$number&senderid=writeYourMailId&message=$message");// post data
// query parameter values must be given without squarebrackets.
 // Optional Authentication:
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($curl);
curl_close($curl);
echo $result;


}
?>