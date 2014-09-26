<?php

namespace Koine\Validator;

use Koine\Hash;

/**
 * @author Marcelo Jacobus <marcelo.jacobus@gmail.com>
 */
class ErrorCollection extends Hash
{
    /**
     * Empties the collection
     * @return self
     */
    public function clear()
    {
        foreach ($this->toArray() as $key => $value) {
            $this->delete($key);
        }

        return $this;
    }

    /**
     * Add an error to the collection
     * @param  string $field
     * @param  string $message
     * @return self
     */
    public function add($field, $message)
    {
        if (isset($this[$field])) {
            $this[$field][] = $message;
        } else {
            $this[$field] = new Hash(array($message));
        }

        return $this;
    }
}
