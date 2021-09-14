<?php
/**
 * Copyright © 2021 All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace DominicWatts\Norris\Controller\Adminhtml\Joke;

use DominicWatts\Norris\Model\JokeFactory;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\ForwardFactory;
use Magento\Framework\Registry;

class NewAction extends \DominicWatts\Norris\Controller\Adminhtml\Joke
{
    /**
     * @var \Magento\Backend\Model\View\Result\ForwardFactory
     */
    protected $resultForwardFactory;

    /**
     * @var \DominicWatts\Norris\Model\JokeFactory
     */
    private $jokeFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory
     * @param \DominicWatts\Norris\Model\JokeFactory $jokeFactory
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        ForwardFactory $resultForwardFactory,
        JokeFactory $jokeFactory
    ) {
        $this->resultForwardFactory = $resultForwardFactory;
        $this->jokeFactory = $jokeFactory;
        parent::__construct($context, $coreRegistry);
    }

    /**
     * New action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Forward $resultForward */
        $resultForward = $this->resultForwardFactory->create();
        return $resultForward->forward('edit');
    }
}
