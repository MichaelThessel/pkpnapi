<?php

namespace Api\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;
use Api\Model\PKPBlog;
use Api\Model\DataHandler;

class ApiController extends AbstractActionController {
    protected $pkpBlog;

    public function __construct(PKPBlog $pkpBlog, DataHandler $dataHandler)
    {
        $this->pkpBlog = $pkpBlog;
        $this->dataHandler = $dataHandler;
    }

    /**
     * Fetch Dashboard notifications
     *
     * @return JsonModel
     */
    public function getNotificationsAction()
    {
        $news = $this->pkpBlog->fetchNews();

        return new JsonModel(array('status' => true, 'news' => $news));
    }
}
