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
        // Set Api Config
        if (function_exists('config')) {
             config($config, $configName);
        }
        $this->config = $config;
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
     * Abstract function to check API Payment Response.
     *
     * @return mixed
     */
    public abstract function checkResponse(array $request_arr);
	/**
     * Abstract function to check API Payment Response.
     *
     * @return mixed
     */
    public abstract function callService($method = 'GET', $data = []);
    /**
     * Abstract function to set API Credentials.
     *
     * @return mixed
     */
    public abstract function getLastCommit();

}