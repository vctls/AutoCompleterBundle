<?php

namespace PUGX\AutocompleterBundle\Form\Transformer;

/**
 * The class objects are transformable in a numeric ID and a string representation
 * by implementing methods getId() and __toString().
 * This makes objects manageable by the CollectionToChoicesTransformer.
 */
interface TransformableInterface
{
    /**
     * Returns a unique numeric identifier for the object.
     *
     * @return int
     */
    public function getId();

    /**
     * Returns a string representation of the object.
     *
     * @return string
     */
    public function __toString();
}
