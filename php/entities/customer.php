<?php 
class customer{
    function __construct()
    {
        $this->customer_id = gen_uuid();
    }

    function __destruct()
    {
        
    }
    // Khóa chính
    public $customer_id;

    // Mã khách hàng
    public $customer_code;

    // Họ và tên
    public $fullname;

    // Email
    public $email;

    // Số điện thoại
    public $mobile;

    // Tên dịch vụ đặt:
    public $service_name;

    // Ngày khám
    public $date;

    // Thời gian khám
    public $time;

    // Thông tin bổ sung
    public $description;
}

function gen_uuid() {
    return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        // 32 bits for "time_low"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

        // 16 bits for "time_mid"
        mt_rand( 0, 0xffff ),

        // 16 bits for "time_hi_and_version",
        // four most significant bits holds version number 4
        mt_rand( 0, 0x0fff ) | 0x4000,

        // 16 bits, 8 bits for "clk_seq_hi_res",
        // 8 bits for "clk_seq_low",
        // two most significant bits holds zero and one for variant DCE1.1
        mt_rand( 0, 0x3fff ) | 0x8000,

        // 48 bits for "node"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
    );
}
?>