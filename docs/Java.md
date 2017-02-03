# AlphaKey Java documentation

## Installation
Download ```AlphaKey.java``` from the ```lib``` directory and place it in your Java code's directory.

## Usage :computer:
create an ```AlphaKey``` object:
```
AlphaKey myAlphaKey = new AlphaKey();
```
Customize your ```AlphaKey``` object with your preferred settings like this:

Set the key (A set of keys that'll be tested). For instance, if the key will be set to ```abcdefghijklmnopqrstuvwxyz``` the AlphaKey will only test strings containing lower cased alphabet characters. Code:
```
myAlphaKey.setKey(String key);
```

Set the testing length (The length of the strings to be tested). Code:
```
myAlphaKey.setTestingLength(int testingLength);
```

Set the testing max value (The number of tests that'll be preformed). Code:
```
myAlphaKey.setTestingMaxValue(long testingMaxValue);
```

Set the testing zero index max value (Read ``ZeroIndexExplanation.md`` for further information.). Code:
```
myAlphaKey.setTestingZeroIndexMaxValue(int testingZeroIndexMaxValue);
```

Set the debug function (A function that'll be called every time a test is preformed). Code:
```
myAlphaKey.setDebugFunction(DebugTester DT);
```
The ```setDebugFunction``` method takes a ```DebugTester``` argument. A ```DebugTester``` looks like that:
```
new AlphaKey.DebugTester() {
    @Override
    public void Debug(String result, String guess, int index) {
        // Handle test information.
    }
}
```

Now, find a match with the ```testAgainst``` method like this:
```
String result = myAlphaKey.testAgainst(Tester _T, String target);
```
A Tester is an interface, the ```testAgainst``` function takes a ```Tester``` argument with a ```Test``` function that returns the result made from the guess and a target ```String``` which is the encrypted string you want to decrypt. A ```Tester``` looks like this:
```
AlphaKey.Tester myTester = new AlphaKey.Tester() {
    @Override
    public String Test(String guess) {
        if (guess.equals("jes")){
            return "Jessica";
        }
        return "JESSICA";
    }
};
```
Now, check whether the ```testAgainst```function found a match:
```
if (!result.equals("")){
  // A match was found
  System.out.println(result);
} else {
  // No match was found
  System.out.println("No match was found");
}
```
