<?php

namespace Api\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;

class ApiController extends AbstractActionController {

    /**
     * Fetch Dashboard notifications
     *
     * @return JsonModel
     */
    public function getNotificationsAction()
    {
        return new JsonModel(array('status' => true));
    }
}
