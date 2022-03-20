<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Message;

class OrderCompleted implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        var_dump('Get message');
        $order = $this->data;
        try{
            $this->send1($order);
            $this->send2($order);
        } catch (\Throwable $e) {
        	var_dump([
                'class' => get_class($e),
                'msg' => $e->getMessage(),
                ]);
        }
    }

    private function send1($order)
    {
        var_dump('send message to admin');
        \Mail::send('admin', ['order' => $order], function (Message $message) {
            $message->subject('An Order has been completed');
            $message->to('admin@admin.com');
        });
    }

    private function send2($order)
    {
        var_dump('send message to ambassador');
        \Mail::send('ambassador', ['order' => $order], function (Message $message) use ($order) {
            $message->subject('An Order has been completed');
            $message->to($order['ambassador_email']);
        });
    }

}
