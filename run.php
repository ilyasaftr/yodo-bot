<?php
// Ilyasa Fathur Rahman
// SGB-Team Reborn
set_time_limit(0);
error_reporting(0);
    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    function generateRandomNumber($length = 10) {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    function correct($nomor){
        $cek = substr($nomor,0,1);
        if($cek == "1"){
            $kode_negara = "1";
            $nomor = substr($nomor,1,15);
        }else if($cek == "6"){
            $kode_negara = "62";
            $nomor = substr($nomor,2,15);
        }
        return array($kode_negara, $nomor);
    }
echo '####################################';
echo "\r\n";
echo '# Copyright : @ilyasa48 | SGB-Team #';
echo "\r\n";
echo '####################################';
echo "\r\n";
echo "\r\n";


echo 'Masukkan Kode Referral : '; 
$referral = trim(fgets(STDIN)); 
echo 'Masukkan Jumlah : '; 
$jumlah = trim(fgets(STDIN)); 
$i=1;
while($i <= $jumlah){
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'http://api.yodorun.com/sport/v2/get_invite_code');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "user_id=$referral&language=id");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

$headers = array();
$headers[] = 'Host: api.yodorun.com';
$headers[] = 'User-Agent: okhttp/3.9.1';
$headers[] = 'Content-Type: application/x-www-form-urlencoded';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close ($ch);
$json_data = json_decode($result);
echo "\r\n";
echo "\r\n";
echo "####################################";
echo "\r\n";
echo "Informasi Referral";
echo "\r\n";
echo "Jumlah Referral : ".$json_data->data->invite_num."";
echo "\r\n";
echo "Jumlah Hadiah : Rp ".$json_data->data->total_reward."";
echo "\r\n";
echo '####################################';
echo "\r\n";
echo "\r\n";
echo "\r\n";
echo "\r\n";

$sign = generateRandomString(27);
$device_id = generateRandomString(16);
$type = generateRandomNumber(5);
$android_id = generateRandomNumber(15);
echo 'Gunakan Kode Negara Di Awal!';
echo "\r\n";
echo 'Masukkan Nomor (62/1) : ';  
$phone_number = trim(fgets(STDIN));
$phone_number = correct($phone_number);
$kode_negara = $phone_number[0];
$phone_number = $phone_number[1];

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'http://api.yodorun.com/sport/login/phone/upload');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "screen_densityDpi=240&sdk=22&sign=$sign=&source=android_app&country_code=+$kode_negara&phone=$phone_number&screen_density=1.5&client_user_id=-1&os=5.1.1&screen_height=1280&device_id_type=1&yd_network_status=9&device_id=$device_id&xyy=&local_date=2019-03-28&language=id&screen_width=720&phone_type=samsung_sm-n$type_5.1.1&channel=channel_googleplay_abroad&ver=4.2.2.0.9&android_id=$android_id");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

$headers = array();
$headers[] = 'Host: api.yodorun.com';
$headers[] = 'User-Agent: okhttp/3.9.1';
$headers[] = 'Content-Type: application/x-www-form-urlencoded';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close ($ch);
$register = json_decode($result);
if(!$register->code == "0"){
    echo "[$i] [".date('h:i:s')."] Terjadi Kesalahan, $register->msg";
    echo "\r\n";
    exit();
}

ulang_otp:
echo 'Masukkan OTP : ';  
$otp = trim(fgets(STDIN)); 

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'http://api.yodorun.com/sport/login/phone/verify');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "screen_densityDpi=240&sdk=22&sign=$sign&source=android_app&country_code=+$kode_negara&phone=$phone_number&screen_density=1.5&client_user_id=-1&os=5.1.1&code=$otp&screen_height=1280&device_id_type=1&yd_network_status=9&device_id=$device_id&xyy=&local_date=2019-03-28&language=id&screen_width=720&phone_type=samsung_sm-n$type_5.1.1&channel=channel_googleplay_abroad&ver=4.2.2.0.9&android_id=$android_id");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

$headers = array();
$headers[] = 'Host: api.yodorun.com';
$headers[] = 'User-Agent: okhttp/3.9.1';
$headers[] = 'Content-Type: application/x-www-form-urlencoded';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close ($ch);
$get_otp = json_decode($result);


if($get_otp->msg == "Phone or code not correct"){
    echo "[$i] [".date('h:i:s')."] Kode OTP Salah, Mengulang...";
    echo "\r\n";
    goto ulang_otp;
}else if(!preg_match('/code": 0/', $result)) {
    echo "[$i] [".date('h:i:s')."] Terjadi Kesalahan, $get_otp->msg";
    echo "\r\n";   
    exit();
}
$user_id = $get_otp->user_info->user_id;

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'http://api.yodorun.com/sport/v2/upload_invite_code');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "user_id=$user_id&code=$referral&language=id");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

$headers = array();
$headers[] = 'Host: api.yodorun.com';
$headers[] = 'User-Agent: okhttp/3.9.1';
$headers[] = 'Content-Type: application/x-www-form-urlencoded';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close ($ch);
$finish = json_decode($result);
if($finish->msg == "Invalid invite code"){
    echo "[$i] [".date('h:i:s')."] Referral Kode Salah, Berhenti...";
    exit();
}else if($finish->code == "0"){
    echo "[$i] [".date('h:i:s')."] Berhasil, $finish->msg";
    echo "\r\n";
}else if(!$finish->code == "0"){
    echo "[$i] [".date('h:i:s')."] Terjadi Kesalahan, $finish->msg";
    exit();
}
$i++;
}