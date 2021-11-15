<?php

/**
 * PubNubAdapterFactory.php
 *
 * @date      15.11.2021
 * @author    Pascal Paulis <pascal.paulis@baywa-re.com>
 * @file      PubNubAdapterFactory.php
 * @copyright Copyright (c) BayWa r.e. - All rights reserved
 * @license   Unauthorized copying of this source code, via any medium is strictly
 *            prohibited, proprietary and confidential.
 */

namespace BayWaReLusy\PublisherSubscriberTools\Adapter;

use BayWaReLusy\PublisherSubscriberTools\PubSubToolsConfig;
use PubNub\PNConfiguration;
use PubNub\PubNub;
use Laminas\ServiceManager\Factory\FactoryInterface;

/**
 * PubNubAdapterFactory
 *
 * @package     BayWaReLusy
 * @subpackage  PublisherSubscriberTools
 * @author      Pascal Paulis <pascal.paulis@baywa-re.com>
 * @copyright   Copyright (c) BayWa r.e. - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */
class PubNubAdapterFactory implements FactoryInterface
{
    public function __invoke(\Interop\Container\ContainerInterface $container, $requestedName, array $options = null)
    {
        /** @var PubSubToolsConfig $config */
        $config = $container->get(PubSubToolsConfig::class);

        $pnConfiguration = new PNConfiguration();
        $pnConfiguration
            ->setPublishKey($config->getPubnubPublisherKey())
            ->setSubscribeKey($config->getPubnubSubscriberKey())
            ->setSecure(true);

        $pubNubClient = new PubNub($pnConfiguration);

        $pubNubAdapter = new PubNubAdapter();
        $pubNubAdapter->setPubNub($pubNubClient);

        return $pubNubAdapter;
    }
}
