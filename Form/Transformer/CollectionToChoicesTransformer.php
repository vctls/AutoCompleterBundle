<?php

namespace PUGX\AutocompleterBundle\Form\Transformer;

use Doctrine\Common\Persistence\ManagerRegistry;
use PUGX\AutocompleterBundle\Form\Transformer\TransformableInterface as Transformable;
use Symfony\Bridge\Twig\Extension\FormExtension;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

/**
 * Class CollectionToChoicesTransformer
 *
 * @package PUGX\AutocompleterBundle\Form\Transformer
 */
class CollectionToChoicesTransformer implements DataTransformerInterface
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
     * Transforms a collection of objects implementing Transformable
     * to an associative array of strings such as [ "string_representation" => "ID cast to string" ].
     *
     * The numeric IDs MUST be cast to string in order to keep the currently selected choices upon loading the form,
     * because the comparison with the form values will be done on string values with type checking.
     * @see FormExtension::isSelectedChoice()
     *
     * @param object[] $collection
     * @return string[]
     * @throws \Exception
     */
    public function transform($collection)
    {
        if (null === $collection) {
            return [];
        }

        $choices = [];
        foreach ($collection as $object) {

            if ( $object instanceof Transformable )  {

                $choices[$object->__toString()] = strval($object->getId());
            } else {
                $class = get_class($object);
                throw new \Exception("Class $class must implement TransformableInterface.");
            }

        }

        return $choices;
    }

    /**
     * Transforms a string (id) to an object (object).
     *
     * @param string[] $ids
     *
     * @throws TransformationFailedException if object (object) is not found
     *
     * @return object[]|null
     */
    public function reverseTransform($ids)
    {
        if (empty($ids)) {
            return null;
        }

        $objects = [];
        foreach ($ids as $id) {
            $object = $this->registry->getManagerForClass($this->class)->getRepository($this->class)->find($id);
            if (null === $object) {
                throw new TransformationFailedException(
                    sprintf('Object from class %s with id "%s" not found', $this->class, $id)
                );
            }
            $objects[] = $object;
        }

        return $objects;
    }
}
