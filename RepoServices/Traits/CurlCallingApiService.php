<?php
namespace RepoServices\Traits;

trait CurlCallingApiService
{
    /**
     * API Service approval URL to make payments.
     *
     * @var string
     */
    private static $url;

    /**
     * Function to set url to call.
     *
     * @return void
     */
    public function setUrl($url){
        self::$url = $url;
    }

    /**
     * Function to get url to call.
     *
     * @return string
     */
    public function getUrl(){
        return self::$url;
    }

    /**
     * Function to go to Payment Service by Approval URL.
     *
     * @throws \Exception
     *
     * @return void
     */
    public final function callService($method = 'GET', $data = []){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->getUrl());

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_USERAGENT, $this->userAgent);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($curl);

        $result = json_decode($response, true);

        return $result;
    }
}