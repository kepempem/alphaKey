import sys,pprint,imp #Import Modules
AlphaKey = imp.load_source('module.name', '../lib/AlphaKey.py') #Import alphaKey
def debug_function(result,guess,index):
    print(str(index)+": "+guess)
myAlphaKey = AlphaKey.AlphaKey({'IL':"JS",'debug_function':debug_function}) #Create an alphaKey object
myAlphaKey.setTestingMaxValue(100)
myAlphaKey.setTestingLength(7)
myAlphaKey.testAgainst(lambda guess:0,"jes")
