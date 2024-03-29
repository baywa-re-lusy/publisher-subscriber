<?php

/**
 * PublisherSubscriberServiceInterface.php
 *
 * @date      15.11.2021
 * @author    Pascal Paulis <pascal.paulis@baywa-re.com>
 * @file      PublisherSubscriberServiceInterface.php
 * @copyright Copyright (c) BayWa r.e. - All rights reserved
 * @license   Unauthorized copying of this source code, via any medium is strictly
 *            prohibited, proprietary and confidential.
 */

namespace BayWaReLusy\PublisherSubscriber;

/**
 * PublisherSubscriberServiceInterface
 *
 * @package     BayWaReLusy
 * @subpackage  PublisherSubscriber
 * @author      Pascal Paulis <pascal.paulis@baywa-re.com>
 * @copyright   Copyright (c) BayWa r.e. - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */
interface PublisherSubscriberServiceInterface
{
    /**
     * @param string $channel
     * @param array $message
     * @throws PublisherSubscriberException
     */
    public function publish(string $channel, array $message): void;

    /**
     * @param string[] $channels
     * @throws PublisherSubscriberException
     */
    public function subscribe(array $channels): void;
}
