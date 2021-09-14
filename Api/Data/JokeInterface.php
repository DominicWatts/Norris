<?php
/**
 * Copyright © 2021 All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace DominicWatts\Norris\Api\Data;

interface JokeInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{
    const TAG = 'tag';
    const API_UPDATED_AT = 'api_updated_at';
    const ICON_URL = 'icon_url';
    const API_ID = 'api_id';
    const URL = 'url';
    const CREATED_AT = 'created_at';
    const API_CREATED_AT = 'api_created_at';
    const VALUE = 'value';
    const JOKE_ID = 'joke_id';
    const UPDATED_AT = 'updated_at';

    /**
     * Get joke_id
     * @return string|null
     */
    public function getJokeId();

    /**
     * Set joke_id
     * @param string $jokeId
     * @return \DominicWatts\Norris\Api\Data\JokeInterface
     */
    public function setJokeId($jokeId);

    /**
     * Get Tag
     * @return string|null
     */
    public function getTag();

    /**
     * Set Tag
     * @param string $tag
     * @return \DominicWatts\Norris\Api\Data\JokeInterface
     */
    public function setTag($tag);

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \DominicWatts\Norris\Api\Data\JokeExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \DominicWatts\Norris\Api\Data\JokeExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \DominicWatts\Norris\Api\Data\JokeExtensionInterface $extensionAttributes
    );

    /**
     * Get icon_url
     * @return string|null
     */
    public function getIconUrl();

    /**
     * Set icon_url
     * @param string $iconUrl
     * @return \DominicWatts\Norris\Api\Data\JokeInterface
     */
    public function setIconUrl($iconUrl);

    /**
     * Get id
     * @return string|null
     */
    public function getApiId();

    /**
     * Set id
     * @param string $id
     * @return \DominicWatts\Norris\Api\Data\JokeInterface
     */
    public function setApiId($id);

    /**
     * Get Url
     * @return string|null
     */
    public function getUrl();

    /**
     * Set Url
     * @param string $url
     * @return \DominicWatts\Norris\Api\Data\JokeInterface
     */
    public function setUrl($url);

    /**
     * Get Value
     * @return string|null
     */
    public function getValue();

    /**
     * Set Value
     * @param string $value
     * @return \DominicWatts\Norris\Api\Data\JokeInterface
     */
    public function setValue($value);

    /**
     * Get api_created_at
     * @return string|null
     */
    public function getApiCreatedAt();

    /**
     * Set api_created_at
     * @param string $apiCreatedAt
     * @return \DominicWatts\Norris\Api\Data\JokeInterface
     */
    public function setApiCreatedAt($apiCreatedAt);

    /**
     * Get api_updated_at
     * @return string|null
     */
    public function getApiUpdatedAt();

    /**
     * Set api_updated_at
     * @param string $apiUpdatedAt
     * @return \DominicWatts\Norris\Api\Data\JokeInterface
     */
    public function setApiUpdatedAt($apiUpdatedAt);

    /**
     * Get created_at
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set created_at
     * @param string $createdAt
     * @return \DominicWatts\Norris\Api\Data\JokeInterface
     */
    public function setCreatedAt($createdAt);

    /**
     * Get updated_at
     * @return string|null
     */
    public function getUpdatedAt();

    /**
     * Set updated_at
     * @param string $updatedAt
     * @return \DominicWatts\Norris\Api\Data\JokeInterface
     */
    public function setUpdatedAt($updatedAt);
}
