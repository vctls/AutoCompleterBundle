<?php

namespace PUGX\AutocompleterBundle\Tests\Stub;

use PUGX\AutocompleterBundle\Form\Transformer\TransformableInterface;

class Entity implements TransformableInterface
{
    public function getId()
    {
        return 42;
    }

    public function __toString()
    {
        return "forty-two";
    }
}
