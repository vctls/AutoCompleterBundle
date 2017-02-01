PUGXAutocompleterBundle
=======================

This is a fork [PUGX/PUGXAutocompleterBundle](https://github.com/PUGX/PUGXAutoCompleterBundle).
I rolled back php version requirements for personnal needs to php 5.6.

This bundle has a simple, specific purpose: adding an "autocomplete" (also known as "type-ahead")
field.
The typical use case is when you get a Many-to-One relation and you need to display a
form with related entity. If related entity has many thousands of items, using the
classic select is not suitable. Here comes this bundle.

[![Build Status](https://secure.travis-ci.org/vtoulouse/PUGXAutoCompleterBundle.png?branch=master)](http://travis-ci.org/vtoulouse/PUGXAutoCompleterBundle)

Documentation
-------------

[Read the documentation](https://github.com/vtoulouse/PUGXAutoCompleterBundle/tree/master/Resources/doc/index.md)

Installation
------------

All the installation instructions are located in [documentation](https://github.com/vtoulouse/PUGXAutoCompleterBundle/tree/master/Resources/doc/index.md).

Testing
-------
Run vendor/bin/phpunit

License
-------

This bundle is released under the LGPL license. See the [complete license text](https://github.com/vtoulouse/PUGXAutoCompleterBundle/tree/master/Resources/meta/LICENSE).

About
-----

PUGXAutocompleterBundle is a [PUGX](http://pugx.org/) initiative.


Reporting an issue or a feature request
---------------------------------------

Issues and feature requests are tracked in the [Github issue tracker](https://github.com/vtoulouse/PUGXAutoCompleterBundle/issues).

When reporting a bug, it may be a good idea to reproduce it in a basic project
built using the [Symfony Standard Edition](https://github.com/symfony/symfony-standard)
with PUGXAutocompleterBundle installed, to allow developers of the bundle to reproduce the issue by simply cloning it
and following some steps.
