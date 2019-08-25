<?php

namespace RepoServices;
/*
 * Abstract Class PaymentService
 * @package App\Services\PaymentServices
 */

abstract class RepoService {

    /**
     * API configuration.
     *
     * @var array
     */
    protected $config;
    /**
     * Function to set payment API Configuration.
     *
     * @param array $config
     *
     * @throws \Exception
     */
    public function setConfig(array $config = [], $configName = '')
    {
        // Set Api Credentials
        if (function_exists('config')) {
            $this->setApiCredentials(
                config($configName)
            );
        } elseif (!empty($config)) {
            $this->setApiCredentials($config);
        }
    }
    /**
     * Get config.
     *
     * @return array|null
     */
    public function getConfig($anchor) {
        return $this->config[$anchor] ?? NULL;
    }
    /**
     * Function to log API errors.
     *
     * @param string $code
     * @param string $message
     */
    public function logError(string $code, string $message)
    {
        \Log::info($this->getConfig('name') . ' API error occurs; time: ' . date('Y-m-d G:i:s') . ' code: ' . $code . ', message: ' . $message);
    }

    /**
     * Abstract function to check API Payment Response.
     *
     * @return mixed
     */
    public abstract function checkResponse(array $request_arr);
    /**
     * Abstract function to set API Credentials.
     *
     * @return mixed
     */
    public abstract function setApiCredentials(array $credentials);

    public abstract function getLastCommit();

}