<?php

namespace Router;

class Content
{
    protected $content = [];

    /**
     * @fn read
     * 
     * TODO mathod for content handle from DB
     * if empty array set header Bad Request
     *
     * @param array $data
     * @return array
     */
    public function read(array $data): array
    {
        return $this->content = 
        [
            'id' => 1,
            'title' => "First page",
            'content' => "Original content"
        ];
    }

    /**
     * @fn create
     * 
     * TODO method from POST request
     *
     * @return void
     */
    public function create()
    {

    }
}