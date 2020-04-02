<?php

namespace App\Controller;

use App\Service\Serializer;

/**
 * Class IndexController
 * @package App\Controller
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
     */
    public function index()
    {
        return $this->serializer->serialize([
            'Action' => 'Index',
            'TIme' => time()
        ]);
    }
}