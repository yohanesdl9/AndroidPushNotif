package com.example.yohan.firebasepushnotif;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.widget.TextView;

import com.google.firebase.iid.FirebaseInstanceId;

public class MainActivity extends AppCompatActivity {
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        TextView text = (TextView) findViewById(R.id.text);
        String refreshedToken = FirebaseInstanceId.getInstance().getToken();
        text.setText("Refreshed token: " + refreshedToken);
        System.out.println("Refreshed token: " + refreshedToken);
    }
}
