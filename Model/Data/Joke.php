<?php
/**
 * Copyright © 2021 All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace DominicWatts\Norris\Model\Data;

use DominicWatts\Norris\Api\Data\JokeInterface;

class Joke extends \Magento\Framework\Api\AbstractExtensibleObject implements JokeInterface
{
    /**
     * Get joke_id
     * @return string|null
     */
    public function getJokeId()
    {
        return $this->_get(self::JOKE_ID);
    }

    /**
     * Set joke_id
     * @param string $jokeId
     * @return \DominicWatts\Norris\Api\Data\JokeInterface
     */
    public function setJokeId($jokeId)
    {
        return $this->setData(self::JOKE_ID, $jokeId);
    }

    /**
     * Get Tag
     * @return string|null
     */
    public function getTag()
    {
        return $this->_get(self::TAG);
    }

    /**
     * Set Tag
     * @param string $tag
     * @return \DominicWatts\Norris\Api\Data\JokeInterface
     */
    public function setTag($tag)
    {
        return $this->setData(self::TAG, $tag);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \DominicWatts\Norris\Api\Data\JokeExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     * @param \DominicWatts\Norris\Api\Data\JokeExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \DominicWatts\Norris\Api\Data\JokeExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

    /**
     * Get icon_url
     * @return string|null
     */
    public function getIconUrl()
    {
        return $this->_get(self::ICON_URL);
    }

    /**
     * Set icon_url
     * @param string $iconUrl
     * @return \DominicWatts\Norris\Api\Data\JokeInterface
     */
    public function setIconUrl($iconUrl)
    {
        return $this->setData(self::ICON_URL, $iconUrl);
    }

    /**
     * Get id
     * @return string|null
     */
    public function getApiId()
    {
        return $this->_get(self::API_ID);
    }

    /**
     * Set id
     * @param string $id
     * @return \DominicWatts\Norris\Api\Data\JokeInterface
     */
    public function setApiId($id)
    {
        return $this->setData(self::API_ID, $id);
    }

    /**
     * Get Url
     * @return string|null
     */
    public function getUrl()
    {
        return $this->_get(self::URL);
    }

    /**
     * Set Url
     * @param string $url
     * @return \DominicWatts\Norris\Api\Data\JokeInterface
     */
    public function setUrl($url)
    {
        return $this->setData(self::URL, $url);
    }

    /**
     * Get Value
     * @return string|null
     */
    public function getValue()
    {
        return $this->_get(self::VALUE);
    }

    /**
     * Set Value
     * @param string $value
     * @return \DominicWatts\Norris\Api\Data\JokeInterface
     */
    public function setValue($value)
    {
        return $this->setData(self::VALUE, $value);
    }

    /**
     * Get api_created_at
     * @return string|null
     */
    public function getApiCreatedAt()
    {
        return $this->_get(self::API_CREATED_AT);
    }

    /**
     * Set api_created_at
     * @param string $apiCreatedAt
     * @return \DominicWatts\Norris\Api\Data\JokeInterface
     */
    public function setApiCreatedAt($apiCreatedAt)
    {
        return $this->setData(self::API_CREATED_AT, $apiCreatedAt);
    }

    /**
     * Get api_updated_at
     * @return string|null
     */
    public function getApiUpdatedAt()
    {
        return $this->_get(self::API_UPDATED_AT);
    }

    /**
     * Set api_updated_at
     * @param string $apiUpdatedAt
     * @return \DominicWatts\Norris\Api\Data\JokeInterface
     */
    public function setApiUpdatedAt($apiUpdatedAt)
    {
        return $this->setData(self::API_UPDATED_AT, $apiUpdatedAt);
    }

    /**
     * Get created_at
     * @return string|null
     */
    public function getCreatedAt()
    {
        return $this->_get(self::CREATED_AT);
    }

    /**
     * Set created_at
     * @param string $createdAt
     * @return \DominicWatts\Norris\Api\Data\JokeInterface
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * Get updated_at
     * @return string|null
     */
    public function getUpdatedAt()
    {
        return $this->_get(self::UPDATED_AT);
    }

    /**
     * Set updated_at
     * @param string $updatedAt
     * @return \DominicWatts\Norris\Api\Data\JokeInterface
     */
    public function setUpdatedAt($updatedAt)
    {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }
}
