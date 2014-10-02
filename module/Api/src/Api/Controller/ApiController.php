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
        $response = array('status' => false, 'message' => '', 'notifications' => array());

        if ($this->request->isPost()) {
            $postData = $this->request->getPost()->getArrayCopy();
            $this->dataHandler->setData(unserialize($postData['data']));
            if ($this->dataHandler->validate($response['message'])) {
                $this->dataHandler->store();
                $response['posts'] = $this->pkpBlog->fetchPosts();
                $response['status'] = true;
            }
        }
        else {
            $response['message'] = 'Request needs to be POST';
        }

        return new JsonModel($response);
    }
}
