<?php
/**
 * Copyright © 2021 All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace DominicWatts\Norris\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Psr\Log\LoggerInterface;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\HTTP\Client\Curl;
use DominicWatts\Norris\Model\JokeFactory;

class Store extends AbstractHelper
{
    const URL = 'https://api.chucknorris.io/jokes/search?query=beard';

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;
    
    /**
     * @var \Magento\Framework\HTTP\Client\Curl
     */
    protected $curl;
    
    /**
     * @var \DominicWatts\Norris\Model\JokeFactory
     */
    protected $joke;

    /**
     * @param \Magento\Framework\App\Helper\Context $context
     * @param \Psr\Log\LoggerInterface $logger
     * @param \Magento\Framework\HTTP\Client\Curl $curl
     * @param \DominicWatts\Norris\Model\JokeFactory $joke
     */
    public function __construct(
        Context $context,
        LoggerInterface $logger,
        Curl $curl,
        JokeFactory $joke
    ) {
        $this->logger = $logger;
        $this->curl = $curl;
        $this->joke = $joke;
        parent::__construct($context);
    }

    /**
     * Perform http request
     * @param string $url
     * @return array
     */
    public function curlRequest($url)
    {
        try {
            $this->curl->setOption(CURLOPT_CONNECTTIMEOUT, 10);
            $this->curl->setOption(CURLOPT_TIMEOUT, 10);
            $this->curl->setOption(CURLOPT_SSL_VERIFYHOST, 0);
            $this->curl->setOption(CURLOPT_SSL_VERIFYPEER, 0);
            $this->curl->setOption(CURLOPT_RETURNTRANSFER, 1);
            $this->curl->addHeader("Content-Type", "application/x-www-form-urlencoded");

            $this->curl->get($url);
            $response = $this->curl->getBody();

            if ($response === false) {
                return [];
            }

            $array = \Zend_Json::decode($response, true);
            return $array['total'] > 0 ? $array['result'] : [];

        } catch (\Zend_Json_Exception $e) {
            $this->logger->critical(
                __("Response Error : %1", $e->getMessage())
            );
            $this->logger->critical(
                __("Response : %1", $response)
            );
        } catch (\Exception $e) {
            $this->logger->critical($e);
        }
        return [];
    }

    public function getJokes()
    {
        $array = $this->curlRequest(self::URL);
        foreach ($array as $row) {
            $this->storeJoke($row);
        }
    }

    /**
     * Store the joke in db
     * @param array $rowData
     * @return bool
     */
    public function storeJoke($rowData)
    {
        $model = $this->isExist($rowData['id']);
        $model->setApiId($rowData['id']);
        $model->setIconUrl($rowData['icon_url']);
        $model->setUrl($rowData['url']);
        $model->setValue($rowData['value']);
        $model->setApiCreatedAt($rowData['created_at']);
        $model->setApiUpdatedAt($rowData['updated_at']);

        if (isset($rowData['categories']) && is_array($rowData['categories'])) {
            $model->setTag(implode(",", $rowData['categories']));
        }

        try {
            $model->save();
            return true;
        } catch (\Exception $e) {
            $this->logger->critical($e);
        }
        return false;
    }

    /**
     * Already exists by API ID
     * @param string $apiId
     * @return bool|\DominicWatts\Norris\Model\Joke
     */
    public function isExist($apiId)
    {
        if ($apiId) {
            return $this->joke->create()->load($apiId, 'api_id');
        }
        return $this->joke->create();
    }
}
