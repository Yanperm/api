<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EmailModel
 *
 * @author Partc
 */
class EmailModel extends CI_Model {

    public function __construct() {
        parent::__construct();  
        $this->load->library('email');
    }

    public function sendVerificatinEmail($email, $member, $verificationText) {

        $config = Array(
            'useragent' => 'nutmor.com',
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 456,
            'smtp_user' => 'no-reply@nutmor.com',
            'smtp_pass' => 'xkiN8gdviN',
            'mailtype' => 'html',
            'charset' => 'iso-8859-1'
        );
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('no-reply@nutmor.com', "ทีมนัดหมอ");
        $this->email->to($email);
        $this->email->subject("Email Verification");
        $this->email->message("แจ้งยืนยันการสมัครสมาชิกถึงคุณ " . $member . "  กรุณาคลิ๊กที่ลิงค์ หรือ นำลิ้งค์ไปวางที่เว็บเบราเซอร์เพื่อทำการยืนยันที่อยู่บัญชีอีเมล์ของท่าน\n\n https://anchaleeclinic.com/services/drekthara/home/verify/" . $verificationText . "\n" . "\n\nขอบคุณ\nทีมพัฒนาระบบนัดหมอ");
        $this->email->send();
    }

    public function sendNewForgetPassword($emailmember, $membername, $repassword) {
        
        $config = Array(
            'useragent' => 'nutmor.com',
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 456,
            'smtp_user' => 'no-reply@nutmor.com',
            'smtp_pass' => 'xkiN8gdviN',
            'mailtype' => 'html',
            'charset' => 'iso-8859-1'
        );
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('no-reply@nutmor.com', "ทีมนัดหมอ");
        $this->email->to($emailmember);
        $this->email->subject("Nutmor Verification Code");
        $email_body = "$repassword\n รหัส 6 หลักด้านบนคือ Verification Code \n โปรดใส่รหัสนี้เพื่อยืนยันการเปลี่ยนแปลงรหัสผ่านของคุณ\n\nของแสดงความนับถือ\nทีมพัฒนาระบบนัดหมอ";
        $this->email->message($email_body);
        $this->email->send();
        $data['mail'] = $emailmember;
        $this->load->view('header');
        $this->load->view('resetpassword', $data);
        $this->load->view('footer');
    }

    public function sendUpdatePassword($emailmember, $membername, $repassword) {
        $config = Array(
            'useragent' => 'nutmor.com',
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 456,
            'smtp_user' => 'no-reply@nutmor.com',
            'smtp_pass' => 'xkiN8gdviN',
            'mailtype' => 'html',
            'charset' => 'iso-8859-1'
        );
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('no-reply@nutmor.com', "ทีมนัดหมอ");
        $this->email->to($emailmember);
        $this->email->subject("Nutmor Verification Code");
        $this->email->message("แจ้งเปลี่ยนรหัสสมาชิกถึงคุณ " . $membername . " ตามที่ท่านร้องขอการเปลี่ยนแปลงรหัสผ่านที่อยู่บัญชีอีเมล์ของท่าน การกระทำดังกล่าวได้สำเร็จแล้ว \n\nขอบคุณ\nทีมพัฒนาระบบนัดหมอ");
        $this->email->send();
        $forgetpassword['forgetpassword'] = 'อัปเดตรหัสผ่านใหม่แล้ว';
        $this->load->view('header');
        $this->load->view('signin', $forgetpassword);
        $this->load->view('footer');
    }

}
