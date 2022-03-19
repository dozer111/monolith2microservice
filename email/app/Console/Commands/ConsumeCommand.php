<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ConsumeCommand extends Command
{
    protected $signature = 'consume';

    public function handle()
    {
        $conf = new \Rdkafka\Conf();

        $conf->set('bootstrap.servers','pkc-4r297.europe-west1.gcp.confluent.cloud:9092');
        $conf->set('security.protocol','SASL_SSL');
        $conf->set('sasl.mechanism','PLAIN');
        $conf->set('sasl.username','WSSSDP2PBB6ZQGLO');
        $conf->set('sasl.password','EXHzlpa1E5omAT4VLwi0OZGdWGiGVxwqay7QB/J0NNoyARS9BPpNPhs1AJ8B6Ly5');
        $conf->set('group.id','myGroup'); // не важно
        $conf->set('auto.offset.reset','earliest');

        $consumer = new \RdKafka\KafkaConsumer($conf);

        while(true){
            $consumer->subscribe(['default']);
            $message = $consumer->consume(120 * 1000);

            switch ($message->err){
                case RD_KAFKA_RESP_ERR_NO_ERROR:
                    var_dump($message->payload);
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
}
