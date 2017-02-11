# AlphaKey Python documentation

## Installation
Download ```AlphaKey.py``` from the ```lib``` directory then include in your files like this:
```
import AlphaKey
```

## Usage
1. Create an AlphaKey object with your preferred settings like this:
```
myAlphaKey = new AlphaKey({
    'key': "Key here", # Every string containing the characters in this string will be tested when using the testAgainst function.

    'TESTING_LENGTH': 1, # This number is the number of characters the algorithm will start testing strings from. For instance, if the testing length is 4 the algorithm will never test the string jes because it contains only three characters but it will test the string jess because it contains four.

    'TESTING_MAX_VALUE': int(sys.float_info.max), # This number is the maximum number of tests that'll be preformed when using the testAgainst function.

    'debug_function': lambda result,guess,index:0, # This function will be called every time a test is preformed within the testAgainst function. When called, it will receive three arguments, the result, the guess and the index.

    'TESTING_ZERO_INDEX_MAX_VALUE': 3 # Read ZeroIndexExplanation.md for further information.
  })
```
2. Look for a match with the ```testAgainst``` method like this (Assuming you have A ``SHA224`` function that takes a single string argument and returns an encrypted SHA224 hash):
```
result = myAlphaKey.testAgainst(SHA224,"8b42ce777019be06a19e18eea3a6d539a1f73a200dda863f05f817a1")
```
3. Check if a match was found like this:
```
if result is not 0.0:
  print("Match: "+result)
else:
  print("No match was found")
```

### Setters
In order to change the AlphaKey object's options after it was configured, use the following setter methods:

Set the ``key``:
```
myAlphaKey.setKey(String key);
```

Set the ``TESTING_LENGTH``:
```
myAlphaKey.setTestingLength(int testingLength);
```

Set the ``TESTING_MAX_VALUE``:
```
myAlphaKey.setTestingMaxValue(long testingMaxValue);
```

Set the ``debug_function``:
```
myAlphaKey.setDebugFunction(Function debugFunction);
```

Set the ``TESTING_ZERO_INDEX_MAX_VALUE``:
```
myAlphaKey.setTestingZeroIndexMaxValue(int testingZeroIndexMaxValue);
```
