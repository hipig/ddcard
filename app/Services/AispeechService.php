<?php


namespace App\Services;


use App\Exceptions\GatewayErrorException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AispeechService
{
    const URL = "https://tts.duiopen.com/runtime/v2/synthesize?productId=%s&voiceId=%s&apikey=%s";

    public function toSpeech(string $text)
    {
        $config = config('tts.gateways.aispeech');
        $params = $config['params'];

        $endpointUrl = sprintf(self::URL, $config['product_id'], $params['voiceId'], $config['api_key']);

        $context = [
            'productId' => $config['product_id'],
        ];

        $request = [
            'requestId' => Str::random(),
            'audio' => [
                'audioType' => 'mp3',
                'mp3Quality' => 'high',
                'sampleRate' => 16000,
            ],
            'tts' => [
                'text' => $text,
                'textType' => 'text',
                'voiceId' => $params['voiceId'],
                'speed' => $params['speed'],
                'volume' => $params['volume'],
            ]
        ];

        Log::info('aispeech request: ', [$endpointUrl, compact('context', 'request')]);

        $response = Http::post($endpointUrl, compact('context', 'request'));

        if ($response->failed()) {
            throw new GatewayErrorException($response->body(), $response->status(), $response);
        }

        return $response->body();
    }
}
