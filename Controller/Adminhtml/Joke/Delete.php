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

class Delete extends \DominicWatts\Norris\Controller\Adminhtml\Joke
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    private $resultPageFactory;

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
     * Delete action
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('joke_id');
        if ($id) {
            try {
                // init model and delete
                $model = $this->jokeFactory->create();
                $model->load($id);
                $model->delete();
                // display success message
                $this->messageManager->addSuccessMessage(__('You deleted the Joke.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['joke_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a Joke to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}
