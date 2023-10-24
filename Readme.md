Certainly! Here's an updated README document that includes information about the requirement of Docker installation for the development environment:

---

# SortedLinkedList - User Guide

**SortedLinkedList** is a PHP library that provides a sorted linked list. It allows you to create and manage a linked list that maintains values in sorted order. You can use this library to store either integer or string values exclusively.

## Table of Contents

- [Installation](#installation)
- [Usage](#usage)
    - [Creating a SortedLinkedList](#creating-a-sortedlinkedlist)
    - [Adding Elements](#adding-elements)
    - [Removing Elements](#removing-elements)
    - [Checking for Element Existence](#checking-for-element-existence)
    - [Getting the Length of the List](#getting-the-length-of-the-list)
- [Iterator Interface](#iterator-interface)
- [Example](#example)
- [Testing](#testing)
- [Contributing](#contributing)
- [License](#license)
- [Development Environment](#development-environment)

## Installation

To use the SortedLinkedList library, follow these steps:

1. Install the library using Composer:

   ```bash
   composer require cleverg/sorted-linked-list
   ```

2. Now you can start using the SortedLinkedList in your PHP application.

## Usage

### Creating a SortedLinkedList

To create a new SortedLinkedList, you can simply instantiate it:

```php
use Cleverg\SortedLinkedList\SortedLinkedList;

$sortedLinkedList = new SortedLinkedList();
```

### Adding Elements

You can add elements to the SortedLinkedList using the `add` method. The elements are automatically sorted:

```php
$sortedLinkedList->add(3);
$sortedLinkedList->add(1);
$sortedLinkedList->add(2);
```

### Removing Elements

To remove an element from the list, use the `remove` method:

```php
$sortedLinkedList->remove(1);
```

### Checking for Element Existence

You can check if an element exists in the list using the `contains` method:

```php
$contains = $sortedLinkedList->contains(2); // Returns true
```

### Getting the Length of the List

To get the length (number of elements) in the list, you can use the `length` method:

```php
$length = $sortedLinkedList->length();
```

## Iterator Interface

The SortedLinkedList class implements the Iterator interface, allowing you to iterate through the elements in the list using a `foreach` loop:

```php
foreach ($sortedLinkedList as $element) {
    // Iterate through the sorted elements
}
```

## Example

Here's a complete example of using the SortedLinkedList to store and manipulate sorted integer values:

```php
use Cleverg\SortedLinkedList\SortedLinkedList;

$sortedLinkedList = new SortedLinkedList();

$sortedLinkedList->add(3);
$sortedLinkedList->add(1);
$sortedLinkedList->add(2);

$sortedLinkedList->remove(1);

foreach $sortedLinkedList as $element) {
    echo $element->getValue() . ' ';
}
// Output: 2 3
```

## Testing

The library includes PHPUnit tests to ensure its functionality:

1. Make sure you have PHPUnit installed. If not, you can install it using Composer:

   ```bash
   composer require --dev phpunit/phpunit
   ```

2. Run the PHPUnit tests using:

   ```bash
   vendor/bin/phpunit
   ```

## Contributing

If you'd like to contribute to this project or report issues, please visit the [GitHub repository](https://github.com/nowackig/SortedLinkedList) and follow the contribution guidelines.

## License

SortedLinkedList is open-source software licensed under the [MIT License](LICENSE).

---

## Development Environment

**Please Note:** The development environment for this project requires Docker to be installed.

### Makefile

A Makefile has been provided to simplify common development tasks. You can use the following Makefile commands:

- **setup**: Set up the library's local development environment.

- **rebuild**: Rebuild Docker images with the `--no-cache` option.

- **stop**: Stop Docker containers.

- **start**: Start Docker containers.

- **restart**: Restart Docker containers.

- **remove**: Remove Docker containers with the `--force-recreate` option.

- **shell**: Run a shell within a Docker container.

- **run**: Run Docker containers.

- **install**: Install Composer dependencies.

- **cs-fix**: Apply source code coding standards using PHP-CS-Fixer.

- **rector-fix**: Upgrade or refactor source code with provided rectors.

- **test**: Run PHPUnit tests and generate code coverage reports.

- **analyze**: Run static analysis using the Composer static analyzer.

To use these commands, execute them in the project directory using the `make` command. For example:

```bash
make setup
```

These commands are defined in the provided Makefile and automate common development tasks to streamline the development process.

---

That's it! You're ready to start using the SortedLinkedList library in your PHP projects and leverage the provided Makefile for development tasks. Make sure you have Docker installed to set up the development environment effectively. Enjoy using this library and its development tools.