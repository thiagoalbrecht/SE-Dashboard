import processing.serial.*;
import http.requests.*;

// Enter below the password configured in secret/credentials.php
String password = "####";

Serial port;
char currentbyte;
String value = "";
int time;
int polling_rate = 1500; // At least 500ms. 1500ms should be enough.
String[] sensorValues = new String[3];
boolean receivedArduino, kill = false;
String message = "";
String txtcolour = "";
PostRequest post = new PostRequest("https://smartenv.salviano.xyz/put.php");

void setup() {
  size(400, 200);
  //println(Serial.list()); 
  port = new Serial(this, Serial.list()[0], 9600);
}
void draw() {
  background(0);
  outputResponse();
  if (port.available()>0) {
    receivedArduino = true;
    currentbyte = (char)port.read();    
    if (currentbyte != ',') { // Add currentbyte to value until the delimitting comma is received.
      value += currentbyte;
      fill(0, 255, 0);
      circle(30, 30, 20);
    } else {
      //println(value);
      if (millis() - time >= polling_rate) {
        time = millis();
        sensorValues = split(value, '|');
        postValues(sensorValues);
      }
      value = "";
    }
  } else if (!receivedArduino) {
    fill(255);
    textAlign(CENTER);
    textSize(32);
    text("Waiting for Arduino\nserial response...", 200, 85);
  } else {
    fill(255, 0, 0);
    circle(30, 30, 20);
  }
}
