Koine Validator
-----------------

Validator adapter for letting you use whathever awesome validation lib you want.


Code information:

[![Build Status](https://travis-ci.org/koinephp/Validator.png?branch=master)](https://travis-ci.org/koinephp/Validator)
[![Coverage Status](https://coveralls.io/repos/koinephp/Validator/badge.png?branch=master)](https://coveralls.io/r/koinephp/Validator?branch=master)
[![Code Climate](https://codeclimate.com/github/koinephp/Validator.png)](https://codeclimate.com/github/koinephp/Validator)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/koinephp/Validator/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/koinephp/Validator/?branch=master)

Package information:

[![Latest Stable Version](https://poser.pugx.org/koine/validator/v/stable.svg)](https://packagist.org/packages/koine/validator)
[![Total Downloads](https://poser.pugx.org/koine/validator/downloads.svg)](https://packagist.org/packages/koine/validator)
[![Latest Unstable Version](https://poser.pugx.org/koine/validator/v/unstable.svg)](https://packagist.org/packages/koine/validator)
[![License](https://poser.pugx.org/koine/validator/license.svg)](https://packagist.org/packages/koine/validator)
[![Dependency Status](https://gemnasium.com/koinephp/Validator.png)](https://gemnasium.com/koinephp/Validator)


### Usage

```php
class UserValidator extends Validator
{
    /**
     * {@inheritdocs}
     */
    protected function executeValidation($value)
    {
        if (!isset($value['name'])) {
            $this->errors->add('name', 'you must set name');
        } elseif (!$value['name']) {
            $this->errors->add('name', 'name cannot be empty');
        }

        if (!isset($value['lastName'])) {
            $this->errors->add('lastName', 'you must set last name');
        } elseif (!$value['lastName']) {
            $this->errors->add('lastName', 'last name cannot be empty');
        }
    }
}

$user = array(
    'name'     => 'Jon',
    'lastName' => '',
);

$validator = new Validator();
$validator->isValid($user); // false

$validator->getErrors()->toArray();
// array('lastName' => 'last name cannot be empty')

$user['lastName'] = 'Doe';

$validator->isValid($user); // true
```

### Installing

#### Via Composer
Append the lib to your requirements key in your composer.json.

```javascript
{
    // composer.json
    // [..]
    require: {
        // append this line to your requirements
        "koine/validator": "~0.9.0"
    }
}
```

### Alternative install
- Learn [composer](https://getcomposer.org). You should not be looking for an alternative install. It is worth the time. Trust me ;-)
- Follow [this set of instructions](#installing-via-composer)

### Issues/Features proposals

[Here](https://github.com/koinephp/Validator/issues) is the issue tracker.

## Contributing

Please refer to the [contribuiting guide](https://github.com/koinephp/Validator/blob/master/CONTRIBUTING.md).

### Lincense
[MIT](MIT-LICENSE)

### Authors

- [Marcelo Jacobus](https://github.com/mjacobus)
