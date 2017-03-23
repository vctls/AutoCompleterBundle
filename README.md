AutocompleterBundle
=======================

This is a fork [PUGX/PUGXAutocompleterBundle](https://github.com/PUGX/PUGXAutoCompleterBundle).

This bundle has a simple, specific purpose: adding an "autocomplete" (also known as "type-ahead") field.
The typical use case is when you get a Many-to-One or Many-to-Many relation and you need to display a form with related entity.
If related entity has many thousands of items, using the classic select is not suitable.

[![Build Status](https://travis-ci.org/vctls/AutoCompleterBundle.svg?branch=master)](https://travis-ci.org/vctls/AutoCompleterBundle)

Documentation
-------------

[Read the documentation](https://github.com/vctls/AutoCompleterBundle/tree/master/Resources/doc/index.md)

Installation
------------

All the installation instructions are located in [documentation](https://github.com/vctls/AutoCompleterBundle/tree/master/Resources/doc/index.md).

Testing
-------
Run vendor/bin/phpunit

License
-------

This bundle is released under the LGPL license. See the [complete license text](https://github.com/vctls/AutoCompleterBundle/tree/master/Resources/meta/LICENSE).


Reporting an issue or a feature request
---------------------------------------

Issues and feature requests are tracked in the [Github issue tracker](https://github.com/vctls/AutoCompleterBundle/issues).

When reporting a bug, it may be a good idea to reproduce it in a basic project
built using the [Symfony Standard Edition](https://github.com/symfony/symfony-standard)
with PUGXAutocompleterBundle installed, to allow developers of the bundle to reproduce the issue by simply cloning it
and following some steps.
