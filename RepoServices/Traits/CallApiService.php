<?php
namespace RepoServices\Traits;
trait CallApiService
{
    /**
     * API Service approval URL to make payments.
     *
     * @var string
     */
    private $approvalServiceUrl;

    /**
     * Function to go to Payment Service by Approval URL.
     *
     * @throws \Exception
     *
     * @return void
     */
    public final function callService($urlResource, $method = 'GET', $data = []){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, self::URL . '/' .  $urlResource);

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