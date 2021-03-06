BayWa r.e. Publisher/Subscriber Tools
=====================================

[![CircleCI](https://circleci.com/gh/baywa-re-lusy/publisher-subscriber/tree/main.svg?style=svg)](https://circleci.com/gh/baywa-re-lusy/publisher-subscriber/tree/main)

## Installation

To install the Publisher/Subscriber tools, you will need [Composer](http://getcomposer.org/) in your project:

```bash
composer require baywa-re-lusy/publisher-subscriber
```

## Usage

Currently, this library only supports PubNub. However, it uses an Adapter pattern to allow adding other vendors easily.

```php
use BayWaReLusy\PublisherSubscriberTools\PubSubTools;
use BayWaReLusy\PublisherSubscriberTools\PubSubToolsConfig;
use BayWaReLusy\PublisherSubscriberTools\PubSubService;
use BayWaReLusy\PublisherSubscriberTools\Adapter\PubNubAdapter;

$pubSubToolsConfig = new PubSubToolsConfig('publisher-key', 'subscriber-key');
$pubSubTools       = new PubSubTools($pubSubToolsConfig);
$pubSubService     = $pubSubTools->get(PubSubService::class);
$pubSubService->setAdapter($pubSubTools->get(PubNubAdapter::class));
```

Optionally, you can include then the PubSub Client into your Service Manager:

```php
$sm->setService(PubSubTools::class, $pubSubTools);
```
