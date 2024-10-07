<?php

namespace Brighty\Cilog;

use Illuminate\Support\Facades\Http;

class Cilog
{

    private $endpoint;

    public function __construct()
    {
        $this->endpoint = config('cilog.endpoint');
    }

    public static function log(string $message, array $data = [])
    {
        $cilog = new Cilog();
        return $cilog->sendLog($message, $data);
    }

    private function sendLog(string $message, array $data = [])
    {
        $this->endpoint = rtrim($this->endpointInstance(), '/');

        $data = [
            'message' => $message,
            'context' => $data,
            'app' => config('app.name'),
        ];

        $response = Http::post($this->endpoint . '/store', $data);

        if ($response->failed()) {
            throw new Exception('Failed to send log to Cilog.');
        }

        return $response->json();
    }

    private function endpointInstance()
    {
        if (!$this->endpoint) {
            throw new Exception('Cilog endpoint is not set.');
        }

        return $this->endpoint;
    }
}
