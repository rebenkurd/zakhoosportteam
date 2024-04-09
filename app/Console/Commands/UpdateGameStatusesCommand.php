<?php

namespace App\Console\Commands;

use App\Http\Controllers\Backend\PollController;
use App\Models\Poll;
use Illuminate\Console\Command;

class UpdateGameStatusesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'game:update-statuses';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update game statuses based on start_at and end_at fields';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        PollController::updateGameStatuses();
        $this->info('Game statuses updated successfully!');
        return 0;
    }
}
