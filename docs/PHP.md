# AlphaKey PHP documentation

## Installation
Download ```AlphaKey.php``` from the ```lib``` directory and require it like this:
```
<?php
require "./path/to/AlphaKey.php";
...
```

## Usage
1. Create an ```AlphaKey``` object with your preferred settings like this:
```
$myAlphaKey = new AlphaKey(Array(
  "key" => /* Key here */, // Every string containing the characters in this string will be tested when using the testAgainst function.

  "TESTING_LENGTH" => 1, // This number is the number of characters the algorithm will start testing strings from. For instance, if the testing length is 4 the algorithm will never test the string jes since it contains only three characters but it will test the string jess since it contains four.

  "TESTING_MAX_VALUE" => PHP_INT_MAX, // This number is the maximum number of tests that'll be preformed when using the testAgainst function.

  "TESTING_ZERO_INDEX_MAX_VALUE" => 100 // Read ZeroIndexExplanation.md for further information.
  ));
```
