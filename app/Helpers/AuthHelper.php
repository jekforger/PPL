<?php

namespace App\Helpers; // atau namespace sesuai dengan struktur Anda

class AuthHelper {
    public static function logged_in() {
        return isset($_SESSION['user_id']);
    }
}