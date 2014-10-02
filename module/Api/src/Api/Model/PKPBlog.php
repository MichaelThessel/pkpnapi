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
    public function fetchPosts()
    {
        $response = ClientStatic::get(
            $this->blogUrl . '/wp-json/posts'
        );
        if ($response->getStatusCode() != 200) return array();

        $news = Decoder::decode($response->getBody());
        if (empty($news) or !array($news)) return array();

        // Restructure the data
        array_walk($news, function(&$n) {
            $n = array(
                'title' => $n->title,
                'body' => $n->content,
                'href' => $n->link,
            );
        });

        return $news;
    }
}
