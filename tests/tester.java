// This file is written assuming the AlphaKey class is imported.
public class Tester {
  public static void main(String[] args) {
    AlphaKey myAlphaKey = new AlphaKey();
    myAlphaKey.setTestingLength(3); // Will start testing from three character strings.
    myAlphaKey.setDebugFunction(setDebugFunction(new AlphaKey.DebugTester() {
        @Override
        public void Debug(String result, String guess, int index) {
            System.out.println("TEST INFO: "+index+": "+result+" ["+guess+"]");
        }
    })); // Print testing info
    AlphaKey.Tester myTester = new AlphaKey.Tester(){
      @Override
      public String Test(String guess) {
        if(guess.equals("jes")){
          return "Jessica";
        }
        return "JESSICA";
      }
    };
    myAlphaKey.testAgainst(myTester,"Jessica");
  }
}
