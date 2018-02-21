<?php

namespace Application\Consumer;


use PhpAmqpLib\Message\AMQPMessage;
use RabbitMqModule\ConsumerInterface;

class EchoAndRejectConsumer implements ConsumerInterface
{
    /**
     * @param AMQPMessage $message
     *
     * @return int
     */
    public function execute(AMQPMessage $message): int
    {
        echo $message->body . PHP_EOL;
        return self::MSG_REJECT;
    }
}