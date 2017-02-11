import struct,sys
from urllib.request import urlopen
defaults = {
    'key':' abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ',
    'TESTING_LENGTH':1,
    'TESTING_MAX_VALUE':int(sys.float_info.max),
    'debug_function':lambda result,guess,index:0,
    'TESTING_ZERO_INDEX_MAX_VALUE':3
}
def CI_HasAttr(obj,p):
    for attr in obj:
        if attr.upper() == p.upper():
            return True
    return False
def CI_GetAttr(obj,p):
    for attr in obj:
        if attr.upper() == p.upper():
            return obj[attr]
    return False
def CI_GetAttrName(obj,p):
    for attr in obj:
        if attr.upper() == p.upper():
            return attr
    return False
def CI_BothHasAttr(objO,objT,p):
    return CI_HasAttr(objO,p) and CI_HasAttr(objT,p)
def sendHTTPRequest(url):
    return urlopen(url).read()
class AlphaKey:
    """Create alphaKeys"""
    def __setitem__(self,p,v):
        return setattr(self,p,v)
    def __getitem__(self,p):
        return getattr(self,p)
    def __hasattr__(self,p):
        return getattr(self,p,None) is not None
    def __hasOption__(self,p):
        return getattr(self.options,p,None) is not None
    def at(self,index):
        return self.options['key'][index]
    def setKey(self,key):
        self.options[CI_GetAttrName(self.options,"key")] = key
        return True
    def setTestingLength(self,length):
        if(type(length) is type(defaults['TESTING_LENGTH']) and length <= len(self.test(CI_GetAttr(self.options,"TESTING_MAX_VALUE")))):
            self.options[CI_GetAttrName(self.options,"TESTING_LENGTH")]=len(CI_GetAttr(self.options,'key'))**(length-1)
            return True
        return False
    def setTestingMaxValue(self,maxValue):
        if(type(maxValue) is type(defaults['TESTING_MAX_VALUE']) and maxValue <= defaults['TESTING_MAX_VALUE']):
            self.options[CI_GetAttrName(self.options,"TESTING_MAX_VALUE")]=maxValue
            return True
        return False
    def setDebugFunction(self,fn):
        if(type(fn) is type(defaults['debug_function'])):
            self.options[CI_GetAttrName(self.options,"debug_function")]=fn
            return True
        return False
    def setTestingZeroIndexMaxValue(self,testingZeroIndexMaxValue):
        if(type(testingZeroIndexMaxValue) is type(defaults['TESTING_ZERO_INDEX_MAX_VALUE'])):
            self.options[CI_GetAttrName(self.options,"TESTING_ZERO_INDEX_MAX_VALUE")]=testingZeroIndexMaxValue
            return True
        return False
    def test(self,index):
        result = 0.0
        index=int(abs(index))
        r = index%len(CI_GetAttr(self.options,"key"))
        if index-r==0:
            result=self.at(r)
        else:
            result=self.test((index-r)/len(CI_GetAttr(self.options,"key")))+self.at(r)
        return result
    def testAgainst(self,fn,target):
        for i in range(-1,CI_GetAttr(self.options,"TESTING_MAX_VALUE")):
            new_i = i+len(CI_GetAttr(self.options,"key"))**(CI_GetAttr(self.options,"TESTING_LENGTH")-1)
            (CI_GetAttr(self.options,"debug_function"))(fn(self.test(new_i)),self.test(new_i),new_i)
            if fn(self.test(new_i))==target:
                return self.test(new_i)
            if CI_GetAttr(self.options,"TESTING_ZERO_INDEX_MAX_VALUE")>0:
                for c in range(1,(CI_GetAttr(self.options,"TESTING_ZERO_INDEX_MAX_VALUE")+1)):
                    if(fn(((self.at(0))*c)+self.test(new_i))==target):
                        return ((self.at(0))*c)+self.test(new_i)
        return 0.0
    def __init__(self,options={}):
        self.options=options
        for attr in list(self.options):
            if (not CI_HasAttr(defaults,attr)):
                del self.options[attr]
            elif type(defaults[CI_GetAttrName(defaults,attr)]) is not type(self.options[attr]):
                self.options[attr] = defaults[CI_GetAttrName(defaults,attr)]
        for attr in list(defaults):
            if(not CI_HasAttr(self.options,attr)):
                self.options[attr]=defaults[CI_GetAttrName(defaults,attr)]
        if not len(CI_GetAttr(self.options,"key")) > 1:
            self.options[CI_GetAttrName(self.options,'key')] = defaults['key']
            raise ValueError('Key must have a minimum length of 2. Changed to default.')
        if CI_GetAttr(self.options,'TESTING_LENGTH') < 1:
            self.options[CI_GetAttrName(self.options,"TESTING_LENGTH")] = 1
