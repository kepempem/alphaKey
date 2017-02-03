/**
	* An AlphaKey object constructor.
	* @author Shani Shlapobersky
	* @see {alphaKey}
	* @return {alphaKey} an alphaKey object.
*/
public class AlphaKey{
    private String mKey = " abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ.@_-,";
    private int mTestingLength = 1;
    private long mTestingMaxValue = Long.MAX_VALUE;
    private int mTestingZeroIndexMaxValue = 100;
    private DebugTester mDebug = new DebugTester() {
        @Override
        public void Debug(String result, String guess, int index) {

        }
    };
    public interface Tester{
        String Test(String guess);
    };
    public interface DebugTester{
        void Debug(String result,String guess,int index);
    };
    public AlphaKey setKey(String key){
        this.mKey = key;
        return this;
    }
    public AlphaKey setTestingLength(int testingLength){
        this.mTestingLength = testingLength;
        return this;
    }
    public AlphaKey setTestingMaxValue(long testingMaxValue){
        this.mTestingMaxValue = testingMaxValue;
        return this;
    }
    public AlphaKey setTestingZeroIndexMaxValue(int testingZeroIndexMaxValue){
        this.mTestingZeroIndexMaxValue = testingZeroIndexMaxValue;
        return this;
    }
    public AlphaKey setDebugFunction(DebugTester DT){
        this.mDebug = DT;
        return this;
    }
    private String repeat(String _S,int _N){
        return new String(new char[_N]).replace("\0", _S);
    }
    private char at(int index){
        return mKey.charAt(index);
    }
    public String test(double index){
        String result = "";
        index = Math.abs(index);
        long r = (long)(index)%mKey.length();
        if (index-r==0){
            result = Character.toString(at((int)r));
        }else{
            result = test((index-r)/mKey.length())+at((int)r);
        }
        return result;
    }
    public String testAgainst(Tester _T,String target){
        for(int i=0;i<=mTestingMaxValue;i++) {
            int new_i = i+(int)(Math.pow(mKey.length(),(mTestingLength-1)));
            String result = (_T.Test(test(new_i)));
            String guess = test(new_i);
            mDebug.Debug(result,guess,new_i);
            if(result.equals(target)){
                return guess;
            }
            if (mTestingZeroIndexMaxValue>0){
              for(int c=0;c<=mTestingZeroIndexMaxValue;c++){
                  if(_T.Test(repeat(Character.toString(at(0)),c)+guess).equals(target)){
                      return repeat(Character.toString(at(0)),c)+guess;
                  }
              }
            }
        }
        return "";
    }
    public AlphaKey(){}
}
