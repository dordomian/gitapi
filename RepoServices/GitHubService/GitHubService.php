<?php

namespace RepoServices\GitHubService;
use RepoServices\Traits\CallApiService;
use RepoServices\RepoService;
/*
 * Class GitHubService
 * @package RepoServices\GitHubService
 */

class GitHubService extends RepoService {
    use CallApiService;

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
     * @throws \Exception
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

	public function checkResponse(array $request_arr){
		
	}

	public function getLastCommit(){

        $url = "{$this->getResource()}/{$this->getRepo()}/branches/{$this->getBranch()}";

        $resultArr = $this->callService($url);

        return $resultArr['commit']['sha']??'';
    }

}