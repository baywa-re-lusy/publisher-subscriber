<?php

/**
 * PubNubService.php
 *
 * @date      15.11.2021
 * @author    Pascal Paulis <pascal.paulis@baywa-re.com>
 * @file      PubNubService.php
 * @copyright Copyright (c) BayWa r.e. - All rights reserved
 * @license   Unauthorized copying of this source code, via any medium is strictly
 *            prohibited, proprietary and confidential.
 */

namespace BayWaReLusy\PublisherSubscriber;

use PubNub\Exceptions\PubNubException;
use PubNub\PNConfiguration;
use PubNub\PubNub;

/**
 * PubNubService
 *
 * @package     BayWaReLusy
 * @subpackage  PublisherSubscriber
 * @author      Pascal Paulis <pascal.paulis@baywa-re.com>
 * @copyright   Copyright (c) BayWa r.e. - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */
class PubNubService implements PublisherSubscriberServiceInterface
{
    /** @var PubNub|null */
    protected ?PubNub $pubNubClient = null;

    protected const MAX_RETRIES       = 3;
    protected const MAX_WAIT_INTERVAL = 6400;

    public function __construct(
        protected string $publisherKey,
        protected string $subscriberKey,
        protected string $userId
    ) {
    }

    /**
     * @return PubNub
     * @throws PublisherSubscriberException
     */
    protected function getPubNubClient(): PubNub
    {
        try {
            if (is_null($this->pubNubClient)) {
                $pnConfiguration = new PNConfiguration();
                $pnConfiguration
                    ->setPublishKey($this->publisherKey)
                    ->setSubscribeKey($this->subscriberKey)
                    ->setUuid($this->userId)
                    ->setSecure(true);

                $this->pubNubClient = new PubNub($pnConfiguration);
            }

            return $this->pubNubClient;
        } catch (PubNubException $e) {
            throw new PublisherSubscriberException("Couldn't create PubNub client.");
        }
    }

    /**
     * {@inheritdoc}
     */
    public function publish(string $channel, $message): void
    {
        $retries = 0;
        $retry   = false;

        do {
            try {
                $this->publishMessage($channel, $message);
            } catch (PublisherSubscriberException $e) {
                $waitTime = min(self::getWaitTimeExp($retries), self::MAX_WAIT_INTERVAL);
                error_log(sprintf(
                    "[%s] Backing off PubNub API for %s ms.",
                    (new \DateTime())->format('c'),
                    $waitTime
                ));
                usleep($waitTime * 1000);
                $retry = true;
            }
        } while ($retry && ($retries++ < self::MAX_RETRIES));

        if ($retries >= self::MAX_RETRIES) {
            error_log(sprintf(
                "[%s] Failed to publish message via PubNub.",
                (new \DateTime())->format('c')
            ));
        }
    }

    /**
     * {@inheritdoc}
     */
    public function subscribe(array $channels): void
    {
        $this
            ->getPubNubClient()
            ->subscribe()
            ->channels($channels);
    }

    /**
     * @param string $channel
     * @param mixed $message
     * @return void
     * @throws PublisherSubscriberException
     */
    protected function publishMessage(string $channel, mixed $message): void
    {
        $this
            ->getPubNubClient()
            ->publish()
            ->channel($channel)
            ->message($message)
            ->usePost(true)
            ->sync();
    }

    /**
     * Returns the next wait interval, in milliseconds, using an exponential
     * backoff algorithm.
     *
     * @param int $retryCount
     * @return int
     */
    protected static function getWaitTimeExp(int $retryCount): int
    {
        return (int)(pow(2, $retryCount) * 100);
    }
}
