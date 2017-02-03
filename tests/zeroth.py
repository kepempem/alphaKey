import imp,pprint
AlphaKey = imp.load_source('module.name', '../lib/AlphaKey.py')
myAlphaKey = AlphaKey.AlphaKey({
    'key': 'jes',
    'TESTING_ZERO_INDEX_MAX_VALUE':1
});
def _TEST(guess):
    if guess == "jes":
        return "Jessica"
    return "JESSICA"
result = myAlphaKey.testAgainst(_TEST,'Jessica')
if result != 0.0:
    print("Match is: "+str(result))
else:
    print("No match found")
