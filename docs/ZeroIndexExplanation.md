# An explanation about the Testing zero index max value option :zero:
The AlphaKey library is using a customized numeric base (Like binary numbers (Base #2) and hexadecimal numbers (Base #16)) every guess is a number represented in that base. therefore, if the base key is (for instance) ```abc``` a guess can only start with either a ```b``` or a ```c``` (unless the index is 0) because the letter ```a``` represents the number zero.
## Example:
``abc`` key numeric base test details:

| Index | Guess |
| --- | --- |
| 0 | a |
| 1 | b |
| 2 | c |
| 3 | ba |
| 4 | bb |
| 5 | bc |
| 6 | ca |
| 7 | cb |
| 8 | cc |
| 9 | baa |
| 10 | bab |
| 11 | bac |
| 12 | bba |
| 13 | bbb |
| 14 | bbc |
| 15 | bca |

The ```TESTING_ZERO_INDEX_MAX_VALUE``` option is the number of times the library will insert and guess the character located at the 0th index of the key. For example, if the ```TESTING_ZERO_INDEX_MAX_VALUE``` will be set to ```1``` and the ```key``` will be set to ```abc``` the string ```ab``` will be tested while the string ```aab``` won't. Why? The ``ab`` string is tested because the 0th index is located at the start only once while in the ```aab``` there are two ``a`` characters.
