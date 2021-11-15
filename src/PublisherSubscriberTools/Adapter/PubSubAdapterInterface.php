<?php

/**
 * PubSubAdapterInterface.php
 *
 * @date      15.11.2021
 * @author    Pascal Paulis <pascal.paulis@baywa-re.com>
 * @file      PubSubAdapterInterface.php
 * @copyright Copyright (c) BayWa r.e. - All rights reserved
 * @license   Unauthorized copying of this source code, via any medium is strictly
 *            prohibited, proprietary and confidential.
 */

namespace BayWaReLusy\PublisherSubscriberTools\Adapter;

/**
 * PubSubAdapterInterface
 *
 * @package     BayWaReLusy
 * @subpackage  PublisherSubscriberTools
 * @author      Pascal Paulis <pascal.paulis@baywa-re.com>
 * @copyright   Copyright (c) BayWa r.e. - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */
interface PubSubAdapterInterface
{
    /**
     * @param string $channel
     * @param string $message
     */
    public function publish(string $channel, string $message): void;

    /**
     * @param string[] $channels
     */
    public function subscribe(array $channels): void;
}
