<?php
namespace App\Http\Traits;
use GuzzleHttp\Client;

trait eDevletTrait {
    protected $client;

    // Define constants for URLs and user agent
    protected $baseUrl = 'https://www.turkiye.gov.tr/imei-sorgulama?submit';
    protected $userAgent = 'TR';
    protected $captchaName = '12345'; // Assume captcha is handled elsewhere
    protected $timeout = 20000; // Timeout for requests

    // Constructor to initialize Guzzle client
    public function __construct() {
        $this->client = new Client(['cookies' => true, 'timeout' => $this->timeout]);
    }

    // Function to make GET and POST requests
    private function sendRequest($method, $url, $headers = [], $formParams = []) {
        $options = ['headers' => $headers];

        if (!empty($formParams)) {
            $options['form_params'] = $formParams;
        }

        return $this->client->request($method, $url, $options);
    }

    // Function to extract token from HTML response
    private function extractToken($response) {
        preg_match_all('@<body (.*?)">@si', $response->getBody(), $matches);
        $attributes = explode('"', $matches[1][0] ?? '');
        return $attributes[3] ?? null;
    }

    // Function to extract IMEI information from the response
    private function extractImeiDetails($responseBody) {
        $resultContainer = explode('<div class="resultContainer"', $responseBody);
        $content = explode('</dl>', $resultContainer[1] ?? '');
        $dataBlock = str_replace('<dl class="compact">', '', $content[0] ?? '');
        $dataItems = explode('</dd>', $dataBlock);

        $status = trim(str_replace(['<dt>', '</dt>', '<dd>', 'Durum'], '', $dataItems[1] ?? ''));
        $source = trim(str_replace(['<dt>', '</dt>', '<dd>', 'Kaynak'], '', $dataItems[2] ?? ''));
        $modelInfo = explode('Model Bilgileri:', $dataItems[4] ?? '');
        $brand = trim(str_replace(['<dt>', '</dt>', '<dd>', 'Marka/Model', 'Marka:'], '', $modelInfo[0] ?? ''));
        $model = trim($modelInfo[1] ?? '');

        return compact('status', 'source', 'brand', 'model');
    }

    public function check($imei) {
        try {
            // Send initial GET request
            $response1 = $this->sendRequest('GET', $this->baseUrl, [
                'User-Agent' => $this->userAgent,
                'stream' => true,
                'read_timeout' => 2000,
            ]);

            // Extract token from the response
            $token = $this->extractToken($response1);

            if (!$token) {
                return response()->json('Token alınamadı', 400);
            }

            // Send POST request to get IMEI details
            $response2 = $this->sendRequest('POST', $this->baseUrl, [
                'User-Agent' => $this->userAgent,
                'stream' => true,
                'timeout' => $this->timeout,
            ], [
                'txtImei' => $imei,
                'token' => $token,
                'captcha_name' => $this->captchaName,
            ]);

            // Extract IMEI details
            $imeiDetails = $this->extractImeiDetails($response2->getBody());

            // Check IMEI status and return response
            if (strstr($imeiDetails['status'], 'IMEI')) {
                return [
                    'isValid' => true,
                    'ImeiStatus' => $imeiDetails['status'],
                    'ImeiSource' => $imeiDetails['source'],
                    'TelephoneBrand' => $imeiDetails['brand'],
                    'TelephoneModel' => $imeiDetails['model'],
                ];
            } elseif ($imeiDetails['status'] == "E-Sim") {
                return [
                    'isValid' => true,
                    'ImeiStatus' => $imeiDetails['status'],
                    'ImeiSource' => "E-Sim",
                    'TelephoneBrand' => $imeiDetails['brand'],
                    'TelephoneModel' => $imeiDetails['model'],
                ];
            } else {
                return [
                    'isValid' => false,
                    'ImeiStatus' => null,
                    'ImeiSource' => null,
                    'TelephoneBrand' => null,
                    'TelephoneModel' => null,
                ];
            }
        } catch (\Exception $e) {
            // Log the exception for debugging (optional)
            \Log::error('E-Devlet IMEI sorgulama hatası: ' . $e->getMessage());
            return response()->json('E-Devlet servisine ulaşılamadı, lütfen daha sonra tekrar deneyin.', 503);
        }
    }
}
