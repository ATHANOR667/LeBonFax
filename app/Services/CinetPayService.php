<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class CinetPayService
{
    protected string $siteId;
    protected string $apiKey;
    protected string $secretKey;

    public function __construct()
    {
        $this->siteId = env('CINETPAY_SITE_ID');
        $this->apiKey = env('CINETPAY_API_KEY');
        $this->secretKey = env('CINETPAY_SECRET_KEY');
    }

    /**
     * Générer un lien de paiement en appelant l'API CinetPay
     *
     * @param array $formData
     * @return array
     * @throws GuzzleException
     */

    public function generatePaymentLink(array $formData): array
    {
        $client = new Client();

        $formData['apikey'] = $this->apiKey;
        $formData['site_id'] = $this->siteId;
        //$formData =  json_encode($formData);

        try {
            $response = $client->post('https://api-checkout.cinetpay.com/v2/payment', [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'json' => ($formData) ,
                'verify' => false,
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            return [
                'code' => '500',
                'message' => $e->getMessage(),
            ];
        }
    }


    /**
     *
     * Vérifier une transaction avec cinetPay
     *
     * @param string $transactionId
     * @param string $token
     * @return array
     * @throws GuzzleException
     */
    public function checkPayment(string $transactionId , string $token): array
    {
        $client = new Client();

        try {
            $response = $client->post('https://api-checkout.cinetpay.com/v2/payment/check', [
                'json' => [
                    'token' => $token,
                    'transaction_id' => $transactionId,
                    'site_id' => $this->siteId,
                    'apikey' => $this->apiKey,
                ],
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'verify' => false,

            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            return [
                'code' => '500',
                'message' => $e->getMessage(),
            ];
        }
    }
}
