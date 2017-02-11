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

  "TESTING_ZERO_INDEX_MAX_VALUE" => 3 // Read ZeroIndexExplanation.md for further information.
  ));
```
2. Use the ``testAgainst`` function to find a match like this (This example is used to decrypt SHA1 hashes):
```
$result = $myAlphaKey->testAgainst(create_function('$guess','return sha1($guess);'),$hash);
```
3. Check whether the ``testAgainst`` function found a match:
```
if ($result!==INF){
  // A match was found
} else {
  // No match was found
}
```

### Setters
In order to change the AlphaKey object's options after it was configured, use the following setter methods:

Set the ``key``:
```
$myAlphaKey->setKey(String $key);
```

Set the ``TESTING_LENGTH``:
```
$myAlphaKey->setTestingLength(int $testingLength);
```

Set the ``TESTING_MAX_VALUE``:
```
$myAlphaKey->setTestingMaxValue(long $testingMaxValue);
```

Set the ``TESTING_ZERO_INDEX_MAX_VALUE``:
```
$myAlphaKey->setTestingZeroIndexMaxValue(int $testingZeroIndexMaxValue);
```
