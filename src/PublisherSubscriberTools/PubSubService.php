<?php

/**
 * PubSubService.php
 *
 * @date      15.11.2021
 * @author    Pascal Paulis <pascal.paulis@baywa-re.com>
 * @file      PubSubService.php
 * @copyright Copyright (c) BayWa r.e. - All rights reserved
 * @license   Unauthorized copying of this source code, via any medium is strictly
 *            prohibited, proprietary and confidential.
 */

namespace BayWaReLusy\PublisherSubscriberTools;

use BayWaReLusy\PublisherSubscriberTools\Adapter\PubSubAdapterInterface;

/**
 * Class PubSubService
 *
 * @package     BayWaReLusy
 * @subpackage  PublisherSubscriberTools
 * @author      Pascal Paulis <pascal.paulis@baywa-re.com>
 * @copyright   Copyright (c) BayWa r.e. - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */
class PubSubService
{
    protected ?PubSubAdapterInterface $adapter = null;

    /**
     * Set the adapter.
     *
     * @param PubSubAdapterInterface $adapter
     * @return $this Provides a fluent interface.
     */
    public function setAdapter(PubSubAdapterInterface $adapter): PubSubService
    {
        $this->adapter = $adapter;
        return $this;
    }

    /**
     * @param string $channel
     * @param string $message
     */
    public function publish(string $channel, string $message): void
    {
        $this->adapter->publish($channel, $message);
    }
}
