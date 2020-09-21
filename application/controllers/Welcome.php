<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->output->set_header('Access-Control-Allow-Origin: *');
        $this->output->set_header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
    }
    public function index()
    {
        {
            $data = array(
                array(
                    "หัวข้อ" => "ชี้แจงการเข้าถึงข้อมูล",
                    "ข้อมูล" => "API for application ictutc.com",
                    "พัฒนาโดย" => "อ.ปรัชญานันท์ ญาณเพิ่ม",
                    "แผนกสังกัด " => "เทคโนโลยีสารสนเทศ วิทยาลัยเทคนิคอุบลราชธานี",
                ),
            );
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode($data));
        }
    }
    

    public function SendParker()
    {                   
            $API_URL = "https://onesignal.com/api/v1/notifications";
            $APP_ID = '4a0f2a9d-bfc6-4898-9946-8e29a003b070';
            $API_KEY = 'ZDM2N2QyZTgtODExYS00ZWY4LWE1MWYtODYxZThhMjUyYWYx';
            $message = 'ทดสอบการแจ้ง Notification ด้วย OneSignal'; // ข้อความที่เราต้องการส่ง

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $API_URL);
            $headers = array(
                'Content-type: application/json',
                'Authorization: Basic ' . $API_KEY,
            );
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"app_id\":\"" . $APP_ID . "\",
                \"isIos\": true,
                \"isAndroid\":true,
                \"include_player_ids\": [\"82a17d9d-6fc0-4cbb-9a39-c4a441d30bb0\"],
                \"data\": {\"page\":\"CHECKIN\"},
                \"ios_badgeType\": \"Increase\",
                \"ios_badgeCount\": 1,
                \"headings\": {\"en\":\"เช็คอิน\",\"th\":\"เช็คอิน\"},
                \"contents\": {\"en\":\"" . $message . "\",\"th\":\"" . $message . "\"}}");
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($ch);
            curl_close($ch);
            var_dump($response);
        }

}
