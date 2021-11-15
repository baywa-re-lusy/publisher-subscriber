<?php

use BayWaReLusy\PublisherSubscriberTools\PubSubService;
use BayWaReLusy\PublisherSubscriberTools\Adapter\PubNubAdapter;
use BayWaReLusy\PublisherSubscriberTools\Adapter\PubNubAdapterFactory;

return [
    'service_manager' =>
        [
            'invokables' =>
                [
                    PubSubService::class
                ],
            'factories' =>
                [
                    PubNubAdapter::class => PubNubAdapterFactory::class,
                ],
            'abstract_factories' =>
                [
                ],
            'initializers' =>
                [
                ],
            'shared' =>
                [
                ]
        ]
];
