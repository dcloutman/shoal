# Lampfire Shoal
The Lampfire Shoal consists of PSR-4 autoloader compatible PHP libraries written by David Cloutman. 
It may be used in anyone's projects for any purpose. They are presented in the hope that they may be useful, but their usefulness is not guaranteed.

## Release Notes

### v0.7.0
The goal of this release to clean up the v0.4.0 branch and port all code to be compatable with PHP 7.2 and above only. PHP 5 will not be supported.

### v0.4.0
This version had the following primary goals but was rolled into v0.7.0

- Convert indentation from tabs to four spaces for better PSR-2 conformity. This will break git blame.
- Convert remaining underscore method names to camelCase and deprecate underscore methods, converting them to wrappers.

## Changes from Past Releases

### v0.3.0
- Create unit test coverage for the majority of classes
- Fix bugs from previous releases discovered by unit tests
- Convert method names and variables to camel case to better match PSR standards
- Bring comments into conformity with the PHPDoc standard so that API documentation can be auto-generated
- Improve the password hashing algorithm so that hashes have a higher computational cost.
- Introduce an implementation of a circularly linked list


