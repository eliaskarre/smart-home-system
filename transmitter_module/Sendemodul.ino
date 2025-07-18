#include <ESP8266WiFi.h>
#include <ESP8266WebServer.h>
#include <RCSwitch.h>

RCSwitch mySwitch = RCSwitch(); 
ESP8266WebServer server(80);
 
const char* ssid = "Karre";
const char* password =  "Haifisch1!";

 
void setup() {
 
    Serial.begin(115200);
    mySwitch.enableTransmit(0);
    WiFi.begin(ssid, password);
    pinMode(LED_BUILTIN, OUTPUT);
    
    while (WiFi.status() != WL_CONNECTED) {
 
        delay(500);
        Serial.println("connecting...");
 
    }
 
    Serial.print("IP: ");
    Serial.println(WiFi.localIP()); 
 
    server.on("/send", sendsignal);
 
    server.begin();
 
}
 
void loop() {
 
    server.handleClient(); 

}
 
void sendsignal() {
       
         String protocol = server.arg(0);
         String pulselength = server.arg(1);
         String value = server.arg(2);
         
         mySwitch.setProtocol(protocol.toInt());
         mySwitch.setPulseLength(pulselength.toInt());
         mySwitch.setRepeatTransmit(5);
         mySwitch.send(value.toInt(), 24);

         String message;

         
         for (int i = 0; i < server.args(); i++) {

         message += "Arg " + (String)i + " > ";
         message += server.argName(i) + ": ";
         message += server.arg(i) + "\n";
         }
         
         server.send(200,"text/plain", message);  
}
