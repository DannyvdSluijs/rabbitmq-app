<?php

namespace Application\Consumer;


use PhpAmqpLib\Message\AMQPMessage;
use RabbitMqModule\ConsumerInterface;

class NullConsumer implements ConsumerInterface
{
    /**
     * @param AMQPMessage $message
     *
     * @return true
     */
    public function execute(AMQPMessage $message): bool
    {
        return true;
    }
}