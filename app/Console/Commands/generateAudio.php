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
    protected $signature = 'audio:generate {--init}';

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
        $isInit = $this->option('init');
        $cards = Card::query()->status()->get();

        try {
            foreach ($cards as $card) {
                dispatch(new \App\Jobs\GenerateAudio($card, $isInit));
            }
        } catch (\Exception $e) {
            $this->error(sprintf("%s(%s): %s", $e->getFile(), $e->getLine(), $e->getMessage()));
        }

        $this->info('生成音频结束');
        return true;
    }
}
