<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\advertisement;
use App\Models\User;
use App\Notifications\UserAdDelete;
use App\Notifications\UserSoonAdDelete;
use Illuminate\Support\Carbon;

class ScheduledAdDelete extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:ScheduledAdDelete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        //
        $advertisement = advertisement::where('approve', 1)->orWhere('status', 'inactive')->where('updated_at', '>', Carbon::now()->subMonth())->get();
        foreach ($advertisement as $ad) {
            if ($ad->updated_at >= Carbon::now()->subDays(25)->startOfDay() && $ad->updated_at <= Carbon::now()->subDays(25)->endOfDay())
            {
                $messageForUserSoonDeleteAd = User::where('id', $ad->user_id)->first();
                $messageForUserSoonDeleteAd->notify(new UserSoonAdDelete($ad));
            }
            if ($ad->updated_at >= Carbon::now()->subDays(30)->startOfDay() && $ad->updated_at <= Carbon::now()->subDays(30)->endOfDay())
            {
                $messageForUserDeleteAd = User::where('id', $ad->user_id)->first();
                $ad->status = "inactive";
                $ad->approve = false;
                $messageForUserDeleteAd->notify(new UserAdDelete($ad));
                $ad->save();
                $ad->delete();
            }
        }
    }
}
