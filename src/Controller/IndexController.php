<?php

namespace App\Controller;

use App\Service\Serializer;

/**
 * Class IndexController
 * @package App\Controller
 * @Route("/")
 */
class IndexController
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
            'Action' => 'Index',
            'TIme' => time()
        ]);
    }
}