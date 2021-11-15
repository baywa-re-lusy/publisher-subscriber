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
        $this->getPubNub()
            ->publish()
            ->channel($channel)
            ->message($message)
            ->usePost(true)
            ->sync();
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
}
