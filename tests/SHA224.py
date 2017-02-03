import sys,pprint,imp,hashlib,time,math #Import Modules
AlphaKey = imp.load_source('module.name', '../lib/AlphaKey.py') #Import AlphaKey
myAlphaKey = AlphaKey.AlphaKey({}) #Create an AlphaKey object
def SHA224(_string):
    return hashlib.sha224(_string.encode("utf-8")).hexdigest()
SHA224_lam = lambda _string:SHA224(_string)
SHA224_hash = "8b42ce777019be06a19e18eea3a6d539a1f73a200dda863f05f817a1" # A SHA224 hash for "jes"
start = time.time()
answer = myAlphaKey.testAgainst(SHA224_lam,SHA224_hash)
end = time.time()
if(answer is not 0.0):
    print("Result is: " + answer) # Should output: Result is: jes
else:
    print("No match found.") # Incase no match was found. Default return value is 0.0
print("Testing time: "+str(math.ceil(end-start))+" seconds.")
