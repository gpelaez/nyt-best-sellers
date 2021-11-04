<?php 

namespace App\Services;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class NytApiClient
{
    private string $baseUrl;
    private string $apiKey;

    public function __construct() {
        $this->baseUrl = Config::get('nyt_api.base_url', 'https://api.nytimes.com/svc/books/v3');
        $this->apiKey = Config::get('nyt_api.api_key', 'uLAuobkIxG5nXUw9k3Ikq1gVjEwKN5iG');
    }

    public function bestSellers(array $payload = []) {
        $basePayload = [
            'api-key' => $this->apiKey,
            'offset' => 0,
        ];
        $payload = array_merge($basePayload, $payload);

        if(isset($payload['isbn']) && is_array($payload['isbn'])) {
            $payload['isbn'] = implode(';', $payload['isbn']);
        }
        $payload = array_filter($payload);

        $response = Http::get(
            $this->baseUrl . '/lists/best-sellers/history.json', 
            $payload
        );
        return $response->body();

    }
    
}
