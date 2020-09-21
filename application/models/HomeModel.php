<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HomeModel
 *
 * @author Partc
 */
class HomeModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function verifyEmailAddress($code) {
        $sql = "update tbmembers set ACTIVATE_STATUS='1' WHERE email_verification_code=?";
        $this->db->query($sql, array($code));
        return $this->db->affected_rows();
    }

    public function updatePassword($code) {
        $sql = "update tbmembers set ACTIVATE_STATUS='0' WHERE verificationcode=?";
        $this->db->query($sql, array($code));
        return $this->db->affected_rows();
    }

}
