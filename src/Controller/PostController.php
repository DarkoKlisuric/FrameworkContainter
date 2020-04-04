<?php

namespace App\Controller;

use App\Annotations\Route;
use App\Service\Serializer;

/**
 * Class PostController
 * @package App\Controller
 * @Route("/posts")
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
     * @Route("/")
     */
    public function index()
    {
        return $this->serializer->serialize([
            'Action' => 'Post',
            'TIme' => time()
        ]);
    }

    /**
     * @return string
     * @Route("/one")
     */
    public function one()
    {
        return $this->serializer->serialize([
            'Action' => 'PostOne',
            'TIme' => time()
        ]);
    }
}