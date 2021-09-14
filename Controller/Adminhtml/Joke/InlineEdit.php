<?php
/**
 * Copyright © 2021 All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace DominicWatts\Norris\Controller\Adminhtml\Joke;

use DominicWatts\Norris\Model\JokeFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;

class InlineEdit extends Action
{
    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $jsonFactory;

    /**
     * @var \DominicWatts\Norris\Model\JokeFactory
     */
    private $jokeFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Controller\Result\JsonFactory $jsonFactory
     * @param \DominicWatts\Norris\Model\JokeFactory $jokeFactory
     */
    public function __construct(
        Context $context,
        JsonFactory $jsonFactory,
        JokeFactory $jokeFactory
    ) {
        $this->jokeFactory = $jokeFactory;
        $this->jsonFactory = $jsonFactory;
        parent::__construct($context);
    }

    /**
     * Inline edit action
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];

        if ($this->getRequest()->getParam('isAjax')) {
            $postItems = $this->getRequest()->getParam('items', []);
            if (!count($postItems)) {
                $messages[] = __('Please correct the data sent.');
                $error = true;
            } else {
                foreach (array_keys($postItems) as $modelId) {
                    /** @var \DominicWatts\Norris\Model\Joke $model */
                    $model = $this->jokeFactory->create()->load($modelId);
                    try {
                        $model->setData($postItems[$modelId] + $model->getData());
                        $model->save();
                    } catch (\Exception $e) {
                        $messages[] = "[Joke ID: {$modelId}]  {$e->getMessage()}";
                        $error = true;
                    }
                }
            }
        }

        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }
}
