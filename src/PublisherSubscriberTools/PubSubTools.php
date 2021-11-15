<?php

/**
 * PubSubTools.php
 *
 * @date        15.11.2021
 * @author      Pascal Paulis <pascal.paulis@baywa-re.com>
 * @file        PubSubTools.php
 * @copyright   Copyright (c) BayWa r.e. - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */

namespace BayWaReLusy\PublisherSubscriberTools;

use Laminas\ServiceManager\ServiceManager;

/**
 * Class PubSubTools
 *
 * Entry-point to use the tool-set
 *
 * @package     BayWaReLusy
 * @subpackage  PublisherSubscriberTools
 * @author      Pascal Paulis <pascal.paulis@baywa-re.com>
 * @copyright   Copyright (c) BayWa r.e. - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 *
 * @codeCoverageIgnore
 */
class PubSubTools extends ServiceManager
{
    public function __construct(PubSubToolsConfig $config)
    {
        $services = require __DIR__ . '/../../config/module.config.php';
        parent::__construct($services['service_manager']);

        $this->setService(PubSubToolsConfig::class, $config);
    }
}
