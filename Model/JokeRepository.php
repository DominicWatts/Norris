<?php
/**
 * Copyright © 2021 All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace DominicWatts\Norris\Model;

use DominicWatts\Norris\Api\Data\JokeInterfaceFactory;
use DominicWatts\Norris\Api\Data\JokeSearchResultsInterfaceFactory;
use DominicWatts\Norris\Api\JokeRepositoryInterface;
use DominicWatts\Norris\Model\ResourceModel\Joke as ResourceJoke;
use DominicWatts\Norris\Model\ResourceModel\Joke\CollectionFactory as JokeCollectionFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Store\Model\StoreManagerInterface;

class JokeRepository implements JokeRepositoryInterface
{
    protected $jokeCollectionFactory;
    protected $resource;
    protected $extensibleDataObjectConverter;
    protected $searchResultsFactory;
    private $storeManager;
    protected $dataObjectHelper;
    protected $jokeFactory;
    protected $dataJokeFactory;
    protected $dataObjectProcessor;
    protected $extensionAttributesJoinProcessor;
    private $collectionProcessor;

    /**
     * @param ResourceJoke $resource
     * @param JokeFactory $jokeFactory
     * @param JokeInterfaceFactory $dataJokeFactory
     * @param JokeCollectionFactory $jokeCollectionFactory
     * @param JokeSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourceJoke $resource,
        JokeFactory $jokeFactory,
        JokeInterfaceFactory $dataJokeFactory,
        JokeCollectionFactory $jokeCollectionFactory,
        JokeSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->jokeFactory = $jokeFactory;
        $this->jokeCollectionFactory = $jokeCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataJokeFactory = $dataJokeFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->extensibleDataObjectConverter = $extensibleDataObjectConverter;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \DominicWatts\Norris\Api\Data\JokeInterface $joke
    ) {
        $jokeData = $this->extensibleDataObjectConverter->toNestedArray(
            $joke,
            [],
            \DominicWatts\Norris\Api\Data\JokeInterface::class
        );
        
        $jokeModel = $this->jokeFactory->create()->setData($jokeData);
        
        try {
            $this->resource->save($jokeModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the joke: %1',
                $exception->getMessage()
            ));
        }
        return $jokeModel->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function get($jokeId)
    {
        $joke = $this->jokeFactory->create();
        $this->resource->load($joke, $jokeId);
        if (!$joke->getId()) {
            throw new NoSuchEntityException(__('Joke with id "%1" does not exist.', $jokeId));
        }
        return $joke->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->jokeCollectionFactory->create();
        
        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \DominicWatts\Norris\Api\Data\JokeInterface::class
        );
        
        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model->getDataModel();
        }
        
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \DominicWatts\Norris\Api\Data\JokeInterface $joke
    ) {
        try {
            $jokeModel = $this->jokeFactory->create();
            $this->resource->load($jokeModel, $joke->getJokeId());
            $this->resource->delete($jokeModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Joke: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($jokeId)
    {
        return $this->delete($this->get($jokeId));
    }
}
