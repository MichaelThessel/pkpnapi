<?php

namespace Api\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;
use Api\Model\PKPBlog;

class ApiController extends AbstractActionController {
    protected $pkpBlog;

    public function __construct(PKPBlog $pkpBlog)
    {
        $this->pkpBlog = $pkpBlog;
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
