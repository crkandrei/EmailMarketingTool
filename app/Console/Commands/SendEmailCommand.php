<?php

namespace App\Console\Commands;

use App\Http\Traits\MailSenderTrait;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendEmailCommand extends Command
{
    use MailSenderTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:task';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check Tasks';

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
     * @return int
     */
    public function handle()
    {
        try {

            $tasks = Task::where('is_done',0)->whereDate('date', '<', Carbon::now())->get();

            foreach($tasks as $task){
                $this->consumeTaskMessage($task->group_id,$task->template_id);
                $task->is_done = 1;
                $task->save();
            }

        }catch (EmailException $e){

            error_log('Email exception: '.$e->getMessage());

        }

        return Command::SUCCESS;
    }
}
