<?php

namespace RepoServices;
/*
 * Abstract Class RepoService
 * @package RepoServices
 */

abstract class RepoService {

    /**
     * API configuration.
     *
     * @var array
     */
    protected $config;
    /**
     * Function to set API Configuration.
     *
     * @param array $config
     *
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
     * Abstract function to check API Response.
     *
     * @throws \RepoServices\Exceptions\RepoServiceException
     * @return mixed
     */
    public abstract function checkResponse(array $resultArr);
	/**
     * Abstract function to call API Service.
     *
     * @return mixed
     */
    public abstract function callService($method = 'GET', $data = []);
    /**
     * Abstract function to get API last commit info.
     *
     * @return mixed
     */
    public abstract function getLastCommit($repo, $branch);

}