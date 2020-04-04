<?php

namespace App\Controller;

use App\Service\Serializer;

/**
 * Class PostController
 * @package App\Controller
 */
class PostController
{
    /**
     * @var Serializer
     */
    private Serializer $serializer;

    /**
     * IndexController constructor.
     * @param Serializer $serializer
     */
    public function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @return string
     */
    public function index()
    {
        return $this->serializer->serialize([
            'Action' => 'Post',
            'TIme' => time()
        ]);
    }
}