<?php

namespace AppBundle\Services\Url;

class Check {

    /**
     * return True if status is 200, 302, 301
     * @param type $url
     * @return boolean
     */
    public function isValidStatus($url, $timeout=10) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        $http_respond = curl_exec($ch);
        $http_respond = trim(strip_tags($http_respond));
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if (( $http_code == "200" ) || ( $http_code == "302" ) || ( $http_code == "301" )) {
            return true;
        } else {
            return false;
        }
    }

}
