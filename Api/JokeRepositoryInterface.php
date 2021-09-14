<?php
/**
 * Copyright © 2021 All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace DominicWatts\Norris\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface JokeRepositoryInterface
{

    /**
     * Save Joke
     * @param \DominicWatts\Norris\Api\Data\JokeInterface $joke
     * @return \DominicWatts\Norris\Api\Data\JokeInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \DominicWatts\Norris\Api\Data\JokeInterface $joke
    );

    /**
     * Retrieve Joke
     * @param string $jokeId
     * @return \DominicWatts\Norris\Api\Data\JokeInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($jokeId);

    /**
     * Retrieve Joke matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \DominicWatts\Norris\Api\Data\JokeSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Joke
     * @param \DominicWatts\Norris\Api\Data\JokeInterface $joke
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \DominicWatts\Norris\Api\Data\JokeInterface $joke
    );

    /**
     * Delete Joke by ID
     * @param string $jokeId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($jokeId);
}

