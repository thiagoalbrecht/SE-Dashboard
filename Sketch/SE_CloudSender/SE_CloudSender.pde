import processing.serial.*;
import http.requests.*;

Serial port;
char currentbyte;
String value = "";
int time;
int polling_rate = 1500; // At least 250ms. 1500ms should be enough.
String[] sensorValues = new String[3];
PostRequest post = new PostRequest("https://smartenv.salviano.xyz/put.php");

void setup() {
  //println(Serial.list()); 
  port = new Serial(this, Serial.list()[0], 9600);
}
void draw() {
  if (port.available()>0) {
    currentbyte = (char)port.read();    
    if (currentbyte != ',') { // Add currentbyte to value until the delimitting comma is received.
      value += currentbyte;
    } else {
      //println(value);
      if (millis() - time >= polling_rate) {
        time = millis();
        sensorValues = split(value, '|');
        postValues(sensorValues);
      }
      value = "";
    }
  }
}
