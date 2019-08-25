<?php
namespace App\Services\PaymentServices\Traits;
trait PaymentTransaction
{
    /**
     * API Service approval URL to make payments.
     *
     * @var string
     */
    private $approvalServiceUrl;

    /**
     * Function to set approval service URL.
     *
     * @param string $approvalServiceUrl
     *
     *
     * @return void
     */
    public function setApprovalServiceUrl($approvalServiceUrl) {
        $this->approvalServiceUrl = $approvalServiceUrl;
    }
    /**
     * Function to set get approval API service URL.
     *
     * @param string $code
     *
     *
     * @return string
     */
    public function getApprovalServiceUrl() {
        return $this->approvalServiceUrl;
    }

    /**
     * Function to go to Payment Service by Approval URL.
     *
     * @throws \Exception
     *
     * @return void
     */
    public function goToPaymentService() {
        if(!$this->getApprovalServiceUrl())
            throw new \Exception("Transaction wasn't registered correctly!");
        \Redirect($this->getApprovalServiceUrl())->send();
    }
}