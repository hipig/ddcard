<?php

namespace App\Console\Commands;

use App\Models\Card;
use Illuminate\Console\Command;

class generateAudio extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:audio {vcn=xiaoyan} {speed=30} {volume=80}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate audio for card';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     */
    public function handle()
    {
        $this->info('生成音频开始');
        $cards = Card::query()->status()->get();

        foreach ($cards as $card) {
            dispatch(new \App\Jobs\GenerateAudio($card, [
                'vcn' => $this->argument('vcn'),
                'speed' => $this->argument('speed'),
                'volume' => $this->argument('volume'),
            ]));
        }

        $this->info('生成音频结束');
        return true;
    }
}
