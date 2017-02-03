# AlphaKey JS documentation

## Installation
### :package: npm:
```
npm install alphakey
```
### :bird: Bower:
```
bower install alphaKey
```

## Usage :computer:
1. Create an AlphaKey object with your preferred settings like this:
```
var myAlphaKey = AlphaKey({
    key: AlphaKey().defaults, // Every string containing the characters in this string will be tested when using the testAgainst function.

    TESTING_LENGTH: 1, // This number is the number of characters the algorithm will start testing strings from. For instance, if the testing length is 4 the algorithm will never test the string jes since it contains only three characters but it will test the string jess since it contains four.

    TESTING_MAX_VALUE: Number.MAX_VALUE, // This number is the maximum number of tests that'll be preformed when using the testAgainst function.

    debug_function: function(result,guess,index){}, // This function will be called every time a test is preformed within the testAgainst function. When called, it will receive three arguments, the result, the guess and the index.

    TESTING_ZERO_INDEX_MAX_VALUE: 100 // Read ZeroIndexExplanation.md for further information.
  })
```
2. Test for a match (assuming you have a ```SHA1``` function that takes a single string argument):
```
var result = myAlphaKey.testAgainst(SHA1,"e7bd830ae2d0c840ab7cd2131cd33ff38c069cbe"); // The result should be "jes"
```

**NOTE**: The default return value for the testAgainst function is ```Infinity```, So to check whether a match was found do the following:
```
if (typeof(result)=='string'){
  // A match was found
} else {
  // No match was found
}
```
