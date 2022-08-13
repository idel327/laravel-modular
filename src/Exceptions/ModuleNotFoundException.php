<?php

namespace Idel\Modular\Exceptions;

class ModuleNotFoundException extends \Exception
{
    /**
     * ModuleNotFoundException constructor.
     * 
     * @param string $slug
     */
    public function __construct(string $slug)
    {
        parent::__construct("Module with slug name [{$slug}] not found!");
    }
}