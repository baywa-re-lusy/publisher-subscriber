BayWa r.e. Publisher/Subscriber Tools
=====================================

[![CircleCI](https://circleci.com/gh/baywa-re-lusy/publisher-subscriber/tree/main.svg?style=svg)](https://circleci.com/gh/baywa-re-lusy/publisher-subscriber/tree/main)

## Installation

To install the Publisher/Subscriber tools, you will need [Composer](http://getcomposer.org/) in your project:

```bash
composer require baywa-re-lusy/publisher-subscriber
```

## Usage

Currently, this library only supports PubNub.

```php
$pubNubService = new \BayWaReLusy\PublisherSubscriber\PubNubService(
    <publisher key>
    <subscriber key>
    <user ID>
);
```
