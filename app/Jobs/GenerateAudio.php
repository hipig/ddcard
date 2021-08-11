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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GenerateAudio implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $card;
    protected $business;
    protected $isInit;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Card $card, array $business = [], $isInit = false)
    {
        $this->card = $card;
        $this->business = $business;
        $this->isInit = $isInit;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(XfyunTtsService $ttsService)
    {
        try {
            DB::transaction(function () use ($ttsService) {
                $lang = ['zh', 'en'];
                foreach ($lang as $value) {
                    $nameField = "{$value}_name";
                    $pathField = "{$value}_audio_path";

                    if ($originalPath = $this->card->$pathField) {
                        if ($this->isInit) {
                            Storage::disk('upload')->delete($originalPath);
                        } else {
                            return true;
                        }
                    }

                    $result = $ttsService->toSpeech($this->card->$nameField, $this->business);

                    $path = "audios/" . Str::random(40) . ".mp3";
                    Storage::disk('upload')->put($path, $result['data']['audio']);

                    $this->card->$pathField = $path;
                    $this->card->save();
                }

            });
        } catch (\Exception $e) {
            abort(500, $e->getMessage() ?? '语音合成失败');
        }
    }
}
