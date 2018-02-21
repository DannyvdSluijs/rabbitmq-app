<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

use Application\Consumer\NullConsumer;

return [
    'rabbitmq' => [
        'connection' => [
            // connection name
            'default' => [ // default values
                'type' => 'stream', // Available: stream, socket, ssl, lazy
                'host' => 'rabbitmq',
                'port' => 5672,
                'username' => 'guest',
                'password' => 'guest',
                'vhost' => '/',
                'insist' => false,
                'read_write_timeout' => 2,
                'keep_alive' => false,
                'connection_timeout' => 3,
                'heartbeat' => 0
            ]
        ],
        'producer' => [
            'rabbitmq_app_producer' => [
                'connection' => 'default', // the connection name
                'exchange' => [
                    'type' => 'direct',
                    'name' => 'rabbitmq-app-exchange',
                    'durable' => true,      // (default)
                    'auto_delete' => false, // (default)
                    'internal' => false,    // (default)
                    'no_wait' => false,     // (default)
                    'declare' => true,      // (default)
                    'arguments' => [],      // (default)
                    'ticket' => 0,          // (default)
                    'exchange_binds' => []  // (default)
                ],
                'queue' => [ // optional queue
                    'name' => 'rabbitmq-app-queue', // can be an empty string,
                    'type' => null,         // (default)
                    'passive' => false,     // (default)
                    'durable' => true,      // (default)
                    'auto_delete' => false, // (default)
                    'exclusive' => false,   // (default)
                    'no_wait' => false,     // (default)
                    'arguments' => [
                        'x-dead-letter-exchange' => ['S', 'dead-letter-exchange']
                    ],      // (default)
                    'ticket' => 0,          // (default)
                    'routing_keys' => []    // (default)
                ],
                'auto_setup_fabric_enabled' => true // auto-setup exchanges and queues
            ]
        ],
        'consumer' => [
            'rabbitmq_app_consumer' => [
                'description' => 'A light consumer',
                'connection' => 'default', // the connection name
                'exchange' => [
                    'type' => 'direct',
                    'name' => 'rabbitmq-app-exchange'
                ],
                'queue' => [
                    'name' => 'rabbitmq-app-queue', // can be an empty string,
                    'type' => null,         // (default)
                    'passive' => false,     // (default)
                    'durable' => true,      // (default)
                    'auto_delete' => false, // (default)
                    'exclusive' => false,   // (default)
                    'no_wait' => false,     // (default)
                    'arguments' => [
                        'x-dead-letter-exchange' => ['S', 'dead-letter-exchange']
                    ],      // (default)
                    'ticket' => 0,          // (default)
                    'routing_keys' => []    // (default)
                ],
                'auto_setup_fabric_enabled' => true, // auto-setup exchanges and queues
                'qos' => [
                    // optional QOS options for RabbitMQ
                    'prefetch_size' => 0,
                    'prefetch_count' => 1,
                    'global' => false
                ],
                'callback' => NullConsumer::class,
            ]
        ]
    ]
];
