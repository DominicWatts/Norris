<?php
/**
 * Copyright © 2021 All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace DominicWatts\Norris\Api\Data;

interface JokeSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Joke list.
     * @return \DominicWatts\Norris\Api\Data\JokeInterface[]
     */
    public function getItems();

    /**
     * Set Tag list.
     * @param \DominicWatts\Norris\Api\Data\JokeInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

