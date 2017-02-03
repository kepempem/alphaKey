import android.graphics.Typeface;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.widget.TextView;
import org.w3c.dom.Text;

public class MainActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        AlphaKey _Tester = new AlphaKey().setDebugFunction(new AlphaKey.DebugTester() {
            @Override
            public void Debug(String result, String guess, int index) {
                Log.i("Test info","Guess: "+guess+", Result: "+result);
            }
        }).setKey("jes");
        String result = _Tester.testAgainst(new AlphaKey.Tester() {
            @Override
            public String Test(String guess) {
                if (guess.equals("jes")){
                    return "Jessica";
                }
                return "JESSICA";
            }
        },"Jessica");
        TextView resultTextView = (TextView) findViewById(R.id.result);
        if (!result.equals("")){
            resultTextView.setTypeface(Typeface.DEFAULT);
            resultTextView.setText(result);
        } else {
            resultTextView.setText("No match was found.");
        }
    }
}
