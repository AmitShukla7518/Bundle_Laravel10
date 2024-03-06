<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class Helper
{

    public static function kam_email($subject, $body, $address)
    {
        //$address=array('surya.singh@cogenteservices.com','vishal.verma@cogenteservices.com','kavya.singh@cogenteservices.com');
        $mail = new PHPMailer;
        $mail->isSMTP();
        //$mail->Host = 'mail.cogenteservices.in'; 
        $mail->Host = 'mail.cogenteservices.com';
        $mail->SMTPAuth = true;
        //$mail->Username = 'ems@cogenteservices.in';  
        $mail->Username = 'kam.support@cogenteservices.com';
        //$mail->Password = '987654321';   
        //$mail->Password = 'india@123';                     
        $mail->Password = 'Kam@12345';
        $mail->SMTPSecure = 'TLS';
        $mail->Port = 25;
        $mail->setFrom('kam.support@cogenteservices.com', 'EICHER KAM');

        foreach ($address as $ad) {
            $mail->AddAddress($ad);
        }

        //$mail->addCC('bachansingh.rawat@cogenteservices.com');
        $mail->Subject = $subject;
        $mail->isHTML(true);
        $mail->Body = $body;

        $mymsg = '';
        if (!$mail->send()) {
            //settimestamp('AutoEmail_Attendance','Email Not Sent');
            //echo '.Mailer Error:'. $mail->ErrorInfo;
        } else {
            //settimestamp('AutoEmail_Attendance','Email Sent');
            //echo  '.Mail Send successfully.';
        }
    }




    public static function LocationSms($mob)
    {
        // API URL:- http://site.ping4sms.com/api/smsapi?key=Account key&route=Route&sender=Sender id&number=Number(s)&sms=Message&templateid=DLT_Templateid
        $Template_Id = '1307167039101590813';
        $Sender_Id = 'BHBENZ';
        $API_Key = '4a6bb4bb09e606a375523e692db6e496';
        $Route_Value = '2';
        $msg = 'Dear Customer,Please click on the given link to share your location  ' . env('APP_URL') . '/location/getlocation?cn=' . $mob . ' Regards,BharatBenz';


        $url = "http://site.ping4sms.com/api/smsapi?key=" . $API_Key . "&route=" . $Route_Value . "&sender=" . $Sender_Id . "&number=" . $mob . "&sms=" . urldecode($msg) . "&templateid=" . $Template_Id . "";


        $http = Http::get($url);
        $response = $http->body();
        // dd($http->body());


        // $curl = curl_init();

        // curl_setopt_array($curl, array(
        //     CURLOPT_URL => $url,
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_ENCODING => '',
        //     CURLOPT_MAXREDIRS => 10,
        //     CURLOPT_TIMEOUT => 0,
        //     CURLOPT_FOLLOWLOCATION => true,
        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //     CURLOPT_CUSTOMREQUEST => 'GET',
        //     CURLOPT_HTTPHEADER => array(
        //         'Cookie: ci_session=o3kgf1ls25kql6qmq7fe8u8bar7sbv4c'
        //     ),
        // ));

        // $response = curl_exec($curl);

        // curl_close($curl);
        // echo $response;
        // die;


        // print_r($response);
        $insert = "insert into sms_response (mob,response,send_by)values('" . $mob . "','" . $response . "','" . Auth::user()->name . "');";
        $result = DB::select($insert);
        return ($response);
    }


    public static function template()
    {
        $template = ["1" => "one", "2" => "two", "3" => "three"];
        return $template;
    }

    public static function language()
    {
        $language = ["Tamil" => "Tamil", "Kannada" => "Kannada", "Malyalam" => "Malyalam", "Telugu" => "Telugu", "Hindi" => "Hindi", "English" => "English"];
        return $language;
    }

    public static function createlog($type, $predata, $data, $created_by)
    {
        $query = DB::select("INSERT into log(`type`,`predata`,`data`,`created_by`) values('" . $type . "','" . $predata . "','" . $data . "','" . $created_by . "')");
    }
}

// if (!function_exists('language')) {

// }
