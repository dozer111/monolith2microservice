<?php

declare(strict_types=1);

namespace App\Queues;

use Illuminate\Queue\Queue;
use Illuminate\Contracts\Queue\Queue as QueueContract;
use RdKafka\KafkaConsumer;

/// На стороне микросервиса-исполнителя нам надо только принимать
final class KafkaQueue extends Queue implements QueueContract
{
    private KafkaConsumer $consumer;

    public function __construct(KafkaConsumer $consumer)
    {
        $this->consumer = $consumer;
    }

    public function size($queue = null)
    {
        // TODO: Implement size() method.
    }

    public function push($job, $data = '', $queue = null)
    {
        // TODO: Implement push() method.
    }

    public function pushRaw($payload, $queue = null, array $options = [])
    {
        // TODO: Implement pushRaw() method.
    }

    public function later($delay, $job, $data = '', $queue = null)
    {
        // TODO: Implement later() method.
    }

    public function pop($queue = null)
    {
        $consumer = $this->consumer;
        $consumer->subscribe(['default']);
        $message = $consumer->consume(5*1000);

        switch ($message->err){
            case RD_KAFKA_RESP_ERR_NO_ERROR:
                $job = unserialize($message->payload);
                $job->handle();
                break;
            case RD_KAFKA_RESP_ERR__PARTITION_EOF:
                echo "No messages. Waiting ...\n";
                break;
            case RD_KAFKA_RESP_ERR__TIMED_OUT:
                echo "Timed out\n";
                break;
            default:
                throw new \Exception($message->errstr(),$message->err);
                break;
        }
    }
}
