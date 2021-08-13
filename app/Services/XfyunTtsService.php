<?php


namespace App\Services;


use App\Exceptions\GatewayErrorException;
use Illuminate\Support\Facades\Log;
use WebSocket\Client;

class XfyunTtsService
{
    const HOST = 'tts-api.xfyun.cn';

    const REQUEST_LINE = 'GET /v2/tts HTTP/1.1';

    const SUCCESS_FLAG = 0;

    public function toSpeech(string $text)
    {
        $config = config('tts.gateways.xfyun');

        $date = gmstrftime("%a, %d %b %Y %T %Z", time());

        $sign = $this->generateSignature($date, $config['api_secret']);

        $endpointUrl = sprintf("wss://%s/v2/tts?", self::HOST) . http_build_query([
            'host' => self::HOST,
            'date' => $date,
            'authorization' => $this->generateAuthorization($sign, $config['api_key']),
        ]);

        $common = [
            'app_id' => $config['app_id']
        ];


        $business = array_merge([
            'aue' => 'lame',
            'tte' => "UTF8"
        ], $config['params']);

        if ($business['aue'] === 'lame') {
            $business['sfl'] = 1;
        }

        $data = [
            'text' => base64_encode($text),
            'status' => 2
        ];

        $client = new Client($endpointUrl);
        $client->send(json_encode(compact('common', 'business', 'data')));

        $return = '';
        while (true) {
            try {
                $result = json_decode($client->receive(), true);
                switch ($result['data']['status']) {
                    case 1:
                        $return .= base64_decode($result['data']['audio']);
                        break;
                    case 2:
                        $return .= base64_decode($result['data']['audio']);
                        break 2;
                }
            } catch (\Exception $e) {
                throw $e;
            }
        }

        if ($result['code'] !== self::SUCCESS_FLAG) {
            throw new GatewayErrorException($result->message, 500, $result);
        }

        return $return;
    }

    protected function generateSignature($date, $apiSecret)
    {
        $signatureOrigin = sprintf("host: %s\ndate: %s\n%s", self::HOST, $date, self::REQUEST_LINE);
        $signatureSha = hash_hmac('sha256', $signatureOrigin, $apiSecret, true);

        return base64_encode($signatureSha);
    }

    protected function generateAuthorization($signature, $apiKey)
    {
        return base64_encode("api_key=\"$apiKey\",algorithm=\"hmac-sha256\",headers=\"host date request-line\",signature=\"$signature\"");
    }
}
