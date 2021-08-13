<?php

return [

    'default' => env('TTS_GATEWAY', 'aispeech'),

    'gateways' => [

        // 讯飞语音
        'xfyun' => [
            'driver' => \App\Services\XfyunTtsService::class,
            'app_id' => env('XFYUN_TTS_APP_ID'),
            'api_key' => env('XFYUN_TTS_API_KEY'),
            'api_secret' => env('XFYUN_TTS_API_SECRET'),
            'params' => [
                'vcn' => env('XFYUN_TTS_VCN', 'xiaoyan'),
                'speed' => env('XFYUN_TTS_SPEED', 30),
                'volume' => env('XFYUN_TTS_VOLUME', 80),
            ]
        ],

        // 思必驰
        'aispeech' => [
            'driver' => \App\Services\AiSpeechService::class,
            'product_id' => env('AISPEECH_TTS_PRODUCT_ID'),
            'api_key' => env('AISPEECH_TTS_API_KEY'),
            'params' => [
                'voiceId' => env('AISPEECH_TTS_VOICE_ID', 'lzliafp'),
                'speed' => env('AISPEECH_TTS_SPEED', 0.5),
                'volume' => env('AISPEECH_TTS_VOLUME', 80),
            ],
        ]

    ]
];
