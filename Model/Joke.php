<?php
/**
 * Copyright © 2021 All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace DominicWatts\Norris\Model;

use DominicWatts\Norris\Api\Data\JokeInterface;
use DominicWatts\Norris\Api\Data\JokeInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;

class Joke extends \Magento\Framework\Model\AbstractModel
{
    protected $dataObjectHelper;
    protected $_eventPrefix = 'dominicwatts_norris_joke';
    protected $jokeDataFactory;
    protected $dateTime;

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param JokeInterfaceFactory $jokeDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \DominicWatts\Norris\Model\ResourceModel\Joke $resource
     * @param \DominicWatts\Norris\Model\ResourceModel\Joke\Collection $resourceCollection
     * @param \Magento\Framework\Stdlib\DateTime\DateTime $dateTime
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        JokeInterfaceFactory $jokeDataFactory,
        DataObjectHelper $dataObjectHelper,
        \DominicWatts\Norris\Model\ResourceModel\Joke $resource,
        \DominicWatts\Norris\Model\ResourceModel\Joke\Collection $resourceCollection,
        \Magento\Framework\Stdlib\DateTime\DateTime $dateTime,
        array $data = []
    ) {
        $this->jokeDataFactory = $jokeDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dateTime = $dateTime;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Before save
     */
    public function beforeSave()
    {
        $this->setUpdatedAt($this->dateTime->gmtDate());
        if ($this->isObjectNew()) {
            $this->setCreatedAt($this->dateTime->gmtDate());
        }
        return parent::beforeSave();
    }

    /**
     * Retrieve joke model with joke data
     * @return JokeInterface
     */
    public function getDataModel()
    {
        $jokeData = $this->getData();

        $jokeDataObject = $this->jokeDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $jokeDataObject,
            $jokeData,
            JokeInterface::class
        );

        return $jokeDataObject;
    }
}
