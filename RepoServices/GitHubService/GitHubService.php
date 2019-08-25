<?php

namespace RepoServices\GitHubService;
use RepoServices\RepoService as Repo;
/*
 * Abstract Class PaymentService
 * @package App\Services\PaymentServices
 */

class GitHubService extends Repo {

    /**
     * API configuration.
     *
     * @var array
     */
    protected $config;
	
	protected $userAgent = 'gitUser';
    /**
     * Function to set payment API Configuration.
     *
     * @param array $config
     *
     * @throws \Exception
     */
    protected $repo;

    protected $branch;
	
	protected const URL = 'https://api.github.com';

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
	
	public final function callService($repo, $branch){
		$url = self::URL;
		$curl = curl_init();
		
		curl_setopt($curl, CURLOPT_URL, "{$url}/repos/{$repo}/branches/{$branch}");

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_USERAGENT, $this->userAgent);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($curl);

        return json_decode($response, true);
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
	
	public function checkResponse(array $request_arr){
		
	}
	
	public function setApiCredentials(array $credentials){
		$this->repo = $credentials['repo'];
        $this->branch = $credentials['branch'];
	}

	public function getLastCommit(){
        $resultArr = $this->callService($this->repo, $this->branch);

        return $resultArr['commit']['sha']??'';
    }

}