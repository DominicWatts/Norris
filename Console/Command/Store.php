<?php
/**
 * Copyright © 2021 All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace DominicWatts\Norris\Console\Command;

use DominicWatts\Norris\Helper\Store as StoreHelper;
use Magento\Framework\App\Area;
use Magento\Framework\App\State;
use Magento\Framework\Stdlib\DateTime\DateTime;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Store extends Command
{
    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * @var \DominicWatts\Norris\Helper\Store
     */
    protected $helper;

    /**
     * @var \Magento\Framework\Stdlib\DateTime\DateTime
     */
    protected $dateTime;

    /**
     * @var \Symfony\Component\Console\Input\InputInterface
     */
    protected $input;

    /**
     * @var \Symfony\Component\Console\Output\OutputInterface
     */
    protected $output;

    public function __construct(
        LoggerInterface $logger,
        State $state,
        StoreHelper $helper,
        DateTime $dateTime
    ) {
        $this->logger = $logger;
        $this->state = $state;
        $this->helper = $helper;
        $this->dateTime = $dateTime;
        parent::__construct();
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ) {
        $this->input = $input;
        $this->output = $output;
        $this->state->setAreaCode(Area::AREA_GLOBAL);

        $this->output->writeln((string) __(
            '%1 Start Joke Fetch',
            $this->dateTime->gmtDate()
        ));

        $this->helper->getJokes();

        $this->output->writeln((string) __(
            '%1 Finish Joke Fetch',
            $this->dateTime->gmtDate()
        ));
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName("dominicwatts:norris:store");
        $this->setDescription("Store Chuck Norris jokes");
        parent::configure();
    }
}
