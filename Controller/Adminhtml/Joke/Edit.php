<?php
/**
 * Copyright © 2021 All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace DominicWatts\Norris\Controller\Adminhtml\Joke;

use DominicWatts\Norris\Model\JokeFactory;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;

class Edit extends \DominicWatts\Norris\Controller\Adminhtml\Joke
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var \DominicWatts\Norris\Model\JokeFactory
     */
    private $jokeFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \DominicWatts\Norris\Model\JokeFactory $jokeFactory
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        PageFactory $resultPageFactory,
        JokeFactory $jokeFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->jokeFactory = $jokeFactory;
        parent::__construct($context, $coreRegistry);
    }

    /**
     * Edit action
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('joke_id');
        $model = $this->jokeFactory->create();

        // 2. Initial checking
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This Joke no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        $this->_coreRegistry->register('dominicwatts_norris_joke', $model);

        // 3. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit Joke') : __('New Joke'),
            $id ? __('Edit Joke') : __('New Joke')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Jokes'));
        $resultPage->getConfig()->getTitle()->prepend(
            $model->getApiId() ? __('Edit Joke : %1', $model->getApiId()) : __('New Joke')
        );
        return $resultPage;
    }
}
