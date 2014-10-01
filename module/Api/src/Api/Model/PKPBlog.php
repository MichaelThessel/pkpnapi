<?php

namespace Api\Model;

use Zend\Http\ClientStatic;
use Zend\Json\Decoder;

class PKPBlog
{
    protected $blogUrl;

    public function __construct($blogUrl)
    {
        $this->blogUrl = $blogUrl;
    }

    /**
     * Fetch news from PKP Blog
     *
     * @return mixed Object containing news information
     */
    public function fetchNews()
    {
        $response = ClientStatic::get(
            $this->blogUrl,
            array(),
            array('Accept' => 'application/json')
        );

        if ($response->getStatusCode() != '200') return false;

        return Decoder::decode($response);
    }
}
