/**
   BasicHTTPClient.ino

    Created on: 24.05.2015

*/

#include <Arduino.h>

#include <ESP8266WiFi.h>
#include <ESP8266WiFiMulti.h>
#include <RCSwitch.h>
#include <ESP8266HTTPClient.h>

#include <WiFiClient.h>

ESP8266WiFiMulti WiFiMulti;
RCSwitch mySwitch = RCSwitch();

void setup() {

  Serial.begin(115200);
  // Serial.setDebugOutput(true);
  
  mySwitch.enableReceive(0);
  
  Serial.println();
  Serial.println();
  Serial.println();

  for (uint8_t t = 4; t > 0; t--) {
    Serial.printf("[SETUP] WAIT %d...\n", t);
    Serial.flush();
    delay(1000);
  }

  WiFi.mode(WIFI_STA);
  WiFiMulti.addAP("Elias Phone", "haifisch");

}

void loop() {
  
  if ((WiFiMulti.run() == WL_CONNECTED)) {

    WiFiClient client;

    HTTPClient http;
  if (mySwitch.available()) {

    String value = String(mySwitch.getReceivedValue());

    String pulselength = String(mySwitch.getReceivedDelay());

    String protocol = String(mySwitch.getReceivedProtocol());

    String url = "http://172.20.10.4/scanner.php?value=" + value + "&pulselength=" + pulselength + "&protocol=" + protocol;
    
    Serial.print("[HTTP] begin...\n");
    if (http.begin(client, url)) {  // HTTP


      Serial.print("[HTTP] GET...\n");
      // start connection and send HTTP header
      int httpCode = http.GET();

      // httpCode will be negative on error
      if (httpCode > 0) {
        // HTTP header has been send and Server response header has been handled
        Serial.printf("[HTTP] GET... code: %d\n", httpCode);

        // file found at server
        if (httpCode == HTTP_CODE_OK || httpCode == HTTP_CODE_MOVED_PERMANENTLY) {
          String payload = http.getString();
          Serial.println(payload);
        }
      } else {
        Serial.printf("[HTTP] GET... failed, error: %s\n", http.errorToString(httpCode).c_str());
      }

      http.end();
      mySwitch.resetAvailable();
    } else {
      Serial.printf("[HTTP} Unable to connect\n");
    }
  
  }

  }
}
