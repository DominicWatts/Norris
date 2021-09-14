<?php
/**
 * Copyright © 2021 All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace DominicWatts\Norris\Cron;

use DominicWatts\Norris\Helper\Store as StoreHelper;
use Magento\Framework\Stdlib\DateTime\DateTime;
use Psr\Log\LoggerInterface;

class Store
{
    /**
     * @var \DominicWatts\Norris\Helper\Store
     */
    protected $helper;

    /**
     * @var \Magento\Framework\Stdlib\DateTime\DateTime
     */
    protected $dateTime;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        LoggerInterface $logger,
        StoreHelper $helper,
        DateTime $dateTime
    ) {
        $this->helper = $helper;
        $this->logger = $logger;
        $this->dateTime = $dateTime;
    }

    /**
     * Execute the cron
     *
     * @return void
     */
    public function execute()
    {
        $this->logger->info((string) __(
            '%1 Start Joke Cron Fetch',
            $this->dateTime->gmtDate()
        ));

        $this->helper->getJokes();

        $this->logger->info((string) __(
            '%1 Finish Joke Cron Fetch',
            $this->dateTime->gmtDate()
        ));
    }
}
