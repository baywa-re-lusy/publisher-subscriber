<?php
/**
 * PubSubToolsConfig.php
 *
 * @date        15.11.2021
 * @author      Pascal Paulis <pascal.paulis@baywa-re.com>
 * @file        PubSubToolsConfig.php
 * @copyright   Copyright (c) BayWa r.e. - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */

namespace BayWaReLusy\PublisherSubscriberTools;

/**
 * Class PubSubToolsConfig
 *
 * Config object for PubSubTools
 *
 * @package     BayWaReLusy
 * @author      Pascal Paulis <pascal.paulis@baywa-re.com>
 * @copyright   Copyright (c) BayWa r.e. - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */
class PubSubToolsConfig
{
    protected string $pubnubPublisherKey;
    protected string $pubnubSubscriberKey;

    /**
     * @param string $pubnubPublisherKey
     * @param string $pubnubSubscriberKey
     */
    public function __construct(string $pubnubPublisherKey, string $pubnubSubscriberKey)
    {
        $this->pubnubPublisherKey  = $pubnubPublisherKey;
        $this->pubnubSubscriberKey = $pubnubSubscriberKey;
    }

    /**
     * @return string
     */
    public function getPubnubPublisherKey(): string
    {
        return $this->pubnubPublisherKey;
    }

    /**
     * @return string
     */
    public function getPubnubSubscriberKey(): string
    {
        return $this->pubnubSubscriberKey;
    }
}
