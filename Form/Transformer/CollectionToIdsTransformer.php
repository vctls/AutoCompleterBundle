<?php

namespace PUGX\AutocompleterBundle\Form\Transformer;

use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class CollectionToIdsTransformer implements DataTransformerInterface
{
    /**
     * @var ManagerRegistry
     */
    private $registry;

    /**
     * @var string
     */
    private $class;

    /**
     * @param ManagerRegistry $registry
     * @param string          $class
     */
    public function __construct(ManagerRegistry $registry, $class)
    {
        $this->registry = $registry;
        $this->class = $class;
    }

    /**
     * Transforms an object (object) to a string (id).
     *
     * @param object|null $collection
     *
     * @return string
     */
    public function transform($collection)
    {
        if (null === $collection) {
            return '';
        }

        $ids = [];
        foreach ($collection as $object) {
            array_push($ids, $object->getId());
        }

        return $ids;
    }

    /**
     * Transforms a string (id) to an object (object).
     *
     * @param string $id
     *
     * @throws TransformationFailedException if object (object) is not found
     *
     * @return object|null
     */
    public function reverseTransform($id)
    {
        if (empty($id)) {
            return;
        }
        $object = $this->registry->getManagerForClass($this->class)->getRepository($this->class)->find($id);
        if (null === $object) {
            throw new TransformationFailedException(
                sprintf('Object from class %s with id "%s" not found', $this->class, $id)
            );
        }

        return $object;
    }
}
