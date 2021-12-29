// adding respective libraries
#ifdef ESP32
  #include <WiFi.h>
  #include <HTTPClient.h>
#else
  #include <ESP8266WiFi.h>
  #include <ESP8266HTTPClient.h>
  #include <WiFiClient.h>
#endif

#include <Wire.h>

const char* ssid     = "home";
const char* password = "12345678";

// REPLACE with your Domain name and URL path or IP address with path
const char* serverName = "http://192.168.137.1/sensordata/post-esp-data.php";

String str = "";

void setup() {
// Open serial communications and wait for port to open:
  Serial.begin(9600);
  
  WiFi.begin(ssid, password);
  Serial.println("Connecting");
  while(WiFi.status() != WL_CONNECTED) { 
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.print("Connected to WiFi network with IP Address: ");
  
while (!Serial) {
; // wait for serial port to connect. Needed for native USB port only

}
}

void loop() {
  //Check WiFi connection status
  if(WiFi.status()== WL_CONNECTED){
    HTTPClient http;
    WiFiClient wificlient;
    // Your Domain name with URL path or IP address with path
    http.begin(wificlient,serverName);
    
    // Specify content-type header
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");
    currentValue();

    // Prepare your HTTP POST request data
    String httpRequestData = "value=" + (str);
    Serial.print("httpRequestData: ");
    Serial.println(httpRequestData);
    
    // Send HTTP POST request
    int httpResponseCode = http.POST(httpRequestData);
     
  if (httpResponseCode>0) {
      Serial.print("HTTP Response code: ");
      Serial.println(httpResponseCode);
    }
    else {
      Serial.print("Error code: ");
      Serial.println(httpResponseCode);
    }
    // Free resources
    //http.end();
  }
  else {
    Serial.println("WiFi Disconnected");
  }
  //Send an HTTP POST request every 15 seconds
  //delay(1000);
}


void currentValue(){
  if (Serial.available()) {
  String load = Serial.readString();
  str = load;
  }
 }
