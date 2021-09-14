<?php
/**
 * Copyright © 2021 All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace DominicWatts\Norris\Block\Joke;

use DominicWatts\Norris\Model\ResourceModel\Joke\CollectionFactory;
use Magento\Framework\View\Element\Template\Context;

class Lister extends \Magento\Framework\View\Element\Template
{
    /**
     * @var DominicWatts\Norris\Model\ResourceModel\Joke\CollectionFactory
     */
    protected $collection;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \DominicWatts\Norris\Model\ResourceModel\Joke\CollectionFactory $collection
     * @param array $data
     */
    public function __construct(
        Context $context,
        CollectionFactory $collection,
        array $data = []
    ) {
        $this->collection = $collection;
        parent::__construct($context, $data);
    }

    /**
     * Get jokes collection
     * @return \DominicWatts\Norris\Model\ResourceModel\Joke\Collection
     */
    public function getJokes()
    {
        $collection = $this->collection->create();
        return $collection;
    }

    /**
     * @param date $date
     * @return string
     */
    public function getPrettyDate($date)
    {
        $date = \DateTime::createFromFormat('Y-m-d H:i:s', $date);
        return $date->format('F j, Y, g:i a');
    }
}
