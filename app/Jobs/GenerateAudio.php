<?php

namespace App\Jobs;

use App\Models\Card;
use App\Services\XfyunTtsService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GenerateAudio implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $card;
    protected $business;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Card $card, array $business = [])
    {
        $this->card = $card;
        $this->business = $business;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(XfyunTtsService $ttsService)
    {
        try {
            $lang = ['zh', 'en'];
            foreach ($lang as $value) {
                $nameField = "{$value}_name";
                $pathField = "{$value}_audio_path";

                $result = $ttsService->toSpeech($nameField, $this->business);

                $path = "audios/" . Str::random(40) . ".mp3";
                Storage::disk('upload')->put($path, $result['data']['audio']);

                $this->card->$pathField = $path;
                $this->card->save();
            }
        } catch (\Exception $e) {
            abort(500, $e->getMessage() ?? '语音合成失败');
        }
    }
}
