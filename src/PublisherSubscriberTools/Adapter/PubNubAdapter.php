<?php

/**
 * PubNubAdapter.php
 *
 * @date      15.11.2021
 * @author    Pascal Paulis <pascal.paulis@baywa-re.com>
 * @file      PubNubAdapter.php
 * @copyright Copyright (c) BayWa r.e. - All rights reserved
 * @license   Unauthorized copying of this source code, via any medium is strictly
 *            prohibited, proprietary and confidential.
 */

namespace BayWaReLusy\PublisherSubscriberTools\Adapter;

use PubNub\Exceptions\PubNubException;

/**
 * PubNubAdapter
 *
 * @package     BayWaReLusy
 * @subpackage  PublisherSubscriberTools
 * @author      Pascal Paulis <pascal.paulis@baywa-re.com>
 * @copyright   Copyright (c) BayWa r.e. - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */
class PubNubAdapter implements PubSubAdapterInterface
{
    /** @var \PubNub\PubNub */
    protected $pubNub;

    protected const MAX_RETRIES       = 3;
    protected const MAX_WAIT_INTERVAL = 6400;

    /**
     * @return \PubNub\PubNub
     */
    public function getPubNub(): \PubNub\PubNub
    {
        return $this->pubNub;
    }

    /**
     * @param \PubNub\PubNub $pubNub
     * @return PubNubAdapter
     */
    public function setPubNub(\PubNub\PubNub $pubNub): PubNubAdapter
    {
        $this->pubNub = $pubNub;
        return $this;
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
            } catch (PubNubException $e) {
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
            ->getPubNub()
            ->subscribe()
            ->channels($channels);
    }

    /**
     * @param string $channel
     * @param mixed $message
     * @return void
     * @throws PubNubException
     */
    protected function publishMessage(string $channel, $message): void
    {
        $this
            ->getPubNub()
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
