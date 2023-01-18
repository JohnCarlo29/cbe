<?php

namespace App\Jobs;

use App\Models\SmsLog;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendSMSJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $mobileNumber;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $mobileNumber)
    {
        $this->mobileNumber = $mobileNumber;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //send sms here
        info('sms sent to: ' . $this->mobileNumber);

        SmsLog::create([
            'mobile_number' => $this->mobileNumber,
            'sent_at' => now()
        ]);
    }
}
