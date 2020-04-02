<?php

namespace App\Controller;

use App\Service\Serializer;

class IndexController
{
    /**
     * @var Serializer
     */
    private Serializer $serializer;

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