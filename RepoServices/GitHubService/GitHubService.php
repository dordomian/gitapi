<?php

namespace RepoServices\GitHubService;
use RepoServices\Exceptions\RepoServiceException;
use RepoServices\Traits\CurlCallingApiService;
use RepoServices\RepoService;
/*
 * Class GitHubService
 * @package RepoServices\GitHubService
 */

class GitHubService extends RepoService {
    use CurlCallingApiService;

    /**
     * API configuration.
     *
     * @var array
     */
    protected $config;

    /**
     * API user agent.
     *
     * @var string
     */
	protected $userAgent = 'gitUser';
    /**
     * API resource.
     *
     * @var string
     */
    private $resource = 'repos';
    /**
     * API repo.
     *
     * @var string
     */
    private $repo;
    /**
     * API branch.
     *
     * @var string
     */
    private $branch;
	
	protected const URL = 'https://api.github.com';

    /**
     * Function to set payment API Configuration.
     *
     * @param array $config
     *
     */
    public function setConfig(array $config = [], $configName = '')
    {
        parent::setConfig($config, $configName);

        if (!empty($config['repo'])) {
            $this->setRepo($config['repo']);
        }
        if (!empty($config['branch'])) {
            $this->setBranch($config['branch']);
        }
        if (!empty($config['resource'])) {
            $this->setResource($config['resource']);
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
     * Get resource.
     *
     * @return string
     */
    public function getResource() {
        return $this->resource;
    }
    /**
     * Set resource.
     *
     * @return string
     */
    public function setResource($resource) {
        return $this->resource = $resource;
    }
    /**
     * Get repo.
     *
     * @return string
     */
    public function getRepo() {
        return $this->repo;
    }
    /**
     * Set repo.
     *
     * @return string
     */
    public function setRepo($repo) {
        return $this->repo = $repo;
    }
    /**
     * Get branch.
     *
     * @return string
     */
    public function getBranch() {
        return $this->branch;
    }
    /**
     * Set branch.
     *
     * @return string
     */
    public function setBranch($branch) {
        return $this->branch = $branch;
    }

    /**
     * Check API Response.
     *
     * @return array
     * @throws \RepoServices\Exceptions\RepoServiceException
     */
	public function checkResponse(array $resultArr){
        if(!empty($resultArr['message'])) {
            throw new RepoServiceException($resultArr['message']);
        }
        return $resultArr;
	}

    /**
     * Get API last commit info.
     *
     * @return bool
     * @throws \RepoServices\Exceptions\RepoServiceException
     */
	public function getLastCommit($repo, $branch){

        $this->setUrl(self::URL . '/' . "{$this->getResource()}/{$repo}/branches/{$branch}");

        if($response = $this->checkResponse($this->callService())) {
            return $response['commit'] ?? NULL;
        }
    }

}