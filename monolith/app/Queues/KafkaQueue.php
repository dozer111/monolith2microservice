<?php

declare(strict_types=1);

namespace App\Queues;

use Illuminate\Queue\Queue;
use Illuminate\Contracts\Queue\Queue as QueueContract;
use RdKafka\KafkaConsumer;
use RdKafka\Producer;

final class KafkaQueue extends Queue implements QueueContract
{
    private Producer $producer;

    public function __construct(Producer $producer)
    {
        $this->producer = $producer;
    }

    public function size($queue = null)
    {
        // TODO: Implement size() method.
    }

    public function push($job, $data = '', $queue = null)
    {
        $producer = $this->producer;
        $topic = $producer->newTopic('default');
        $topic->produce(RD_KAFKA_PARTITION_UA,0,serialize($job));
        $producer->flush(50);
        if($producer->getOutQLen()){
            sleep(2);
            $producer->poll(50);
        }
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
    }
}
