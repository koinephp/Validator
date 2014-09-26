<?php

namespace Koine;

/**
 * @author Marcelo Jacobus <marcelo.jacobus@gmail.com>
 */
abstract class Validator
{
    /**
     * @var ErrorCollection
     */
    protected $errors;

    /**
     * @var Hash
     */
    protected $options;

    /**
     * Constructor
     */
    public function __construct(array $options = array())
    {
        $this->options = new Hash($options);
        $this->errors = new Validator\ErrorCollection();
    }

    /**
     * Verifies if the value is valid
     * @return boolean
     */
    public function isValid($value)
    {
        $this->errors->clear();

        $this->executeValidation($value);

        return $this->errors->isEmpty();
    }

    /**
     * Get the errors
     * @return ErrorCollection
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Get the options passed in the constructor
     * @return Hash
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Get the options
     * @param  string $key
     * @return mixed
     */
    public function getOption($key)
    {
        return $this->getOptions()->fetch($key);
    }

    /**
     * This is the method where the validation must really happen
     *
     * In order to make an object invalid, all you need to do is to add an error
     * to the error collection
     *
     *      $this->errors->add('nome', 'Não pode ficar em branco');
     *
     * @param mixed value
     */
    abstract protected function executeValidation($value);
}
