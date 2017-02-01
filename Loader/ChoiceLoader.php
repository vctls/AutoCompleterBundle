<?php

namespace PUGX\AutocompleterBundle\Loader;

use Symfony\Component\Form\ChoiceList\ArrayChoiceList;
use Symfony\Component\Form\ChoiceList\ChoiceListInterface;
use \Symfony\Component\Form\ChoiceList\Loader\ChoiceLoaderInterface;

/**
 * Class ChoiceLoader
 *
 * @package PUGX\AutocompleterBundle\Loader
 */
class ChoiceLoader implements ChoiceLoaderInterface
{

    /** @var ChoiceListInterface */
    private $choiceList;


    /**
     * Loads a list of choices.
     *
     * Optionally, a callable can be passed for generating the choice values.
     * The callable receives the choice as first and the array key as the second
     * argument.
     *
     * @param null|callable $value The callable which generates the values
     *                             from choices
     *
     * @return \Symfony\Component\Form\ChoiceList\ChoiceListInterface The loaded choice list
     */
    public function loadChoiceList($value = null)
    {
        // is called on form view create after loadValuesForChoices of form create
        if ($this->choiceList instanceof ChoiceListInterface) {
            return $this->choiceList;
        }

        // if no values preset yet return empty list
        $this->choiceList = new ArrayChoiceList(array(), $value);

        return $this->choiceList;
    }

    /**
     * Loads the choices corresponding to the given values.
     *
     * The choices are returned with the same keys and in the same order as the
     * corresponding values in the given array.
     *
     * Optionally, a callable can be passed for generating the choice values.
     * The callable receives the choice as first and the array key as the second
     * argument.
     *
     * @param string[] $values An array of choice values. Non-existing
     *                              values in this array are ignored
     * @param null|callable $value The callable generating the choice values
     *
     * @return array An array of choices
     */
    public function loadChoicesForValues(array $values, $value = null)
    {
        // is called on form submit after loadValuesForChoices of form create and loadChoiceList of form view create
        $choices = array();
        foreach ($values as $key => $val) {
            // we use a DataTransformer, thus only plain values arrive as choices which can be used directly as value
            if (is_callable($value)) {
                $choices[$key] = (string)call_user_func($value, $val, $key);
            }
            else {
                $choices[$key] = $val;
            }
        }

        // reset internal choice list
        $this->choiceList = new ArrayChoiceList($choices, $value);

        return $choices;
    }

    /**
     * Loads the values corresponding to the given choices.
     *
     * The values are returned with the same keys and in the same order as the
     * corresponding choices in the given array.
     *
     * Optionally, a callable can be passed for generating the choice values.
     * The callable receives the choice as first and the array key as the second
     * argument.
     * 2017-01-25 vtoulouse: NOT TRUE! actually there is no second argument!
     * @see ArrayChoiceList::flatten()
     *
     * @param array $choices An array of choices. Non-existing choices in
     *                               this array are ignored
     * @param null|callable $value The callable generating the choice values
     *
     * @return string[] An array of choice values
     */
    public function loadValuesForChoices(array $choices, $value = null)
    {
        // is called on form creat with $choices containing the preset of the bound entity
        $values = array();

        // FIXME I had to check the layout of the given $choices array,
        // FIXME as for some reason it can come in three forms:
        /*
         * [
         *    0 => [ OPTION => "VALUE" ]
         * ]
         *
         * [
         *    OPTION => "VALUE"
         * ]
         *
         * [
         *    0 => "VALUE"
         * ]
         */
        if (isset($choices[0]) && is_array($choices[0])) {
            foreach ($choices as $choice) {

                if (is_callable($value)) {
                    $values[key($choice)] = (string)call_user_func($value, current($choice), key($choice));
                }
                else {
                    $values[key($choice)] = current($choice);
                }
            }
        } else

        foreach ($choices as $key => $choice) {

            if (is_callable($value)) {
                $values[$key] = (string)call_user_func($value, $choice, $key);
            }
            else {
                $values[$key] = $choice;
            }
        }

        // create internal choice list from loaded values
        $this->choiceList = new ArrayChoiceList($values, $value);

        return $values;
    }
}