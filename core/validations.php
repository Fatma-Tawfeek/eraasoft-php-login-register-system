<?php 

function requiredVal($input) {
    if(empty($input)) {
        return false;
    }
    return true;
}

function minVal($input, $length) {
    if(strlen($input) < $length) {
        return false;
    }
    return true;
}

function maxVal($input, $length) {
    if(strlen($input) > $length) {
        return false;
    }
    return true;
}

function emailVal($email) {
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }
    return true;
}
 
function checkLogin($email, $password) {
    $users_file = fopen("../data/users.csv", "a+");
    while (($data = fgetcsv($users_file)) !== FALSE) {
        if ($email == $data[1] && sha1($password) == $data[2]) {
            return $data;
        } 
    }
    return false;
}