# SE-Dashboard
Smart Environments Project Dashboard - Team 20

Website: https://smartenv.salviano.xyz

# Arduino and Processing instructions
To sync the data from the Arduino to the website, you will need to use Processing.

The code for both Arduino and Processing are located in the 'Sketch' folder in this repository. 

You can [download the latest ZIP of the Sketch folder here](https://smartenv.salviano.xyz/files/Sketch.zip)

After you open the Processing sketch, you may adjust the serial port of the Arduino in this line (located in *void setup()*), in case the code doesn't work the first time:
```
port = new Serial(this, Serial.list()[0], 9600);
                                      ↑
```
Make sure the Arduino is connected and running the code from the Project_Water_Height.ino, also in the Sketch folder.
Run the Processing sketch and check the processing console output. You should see a
```
Reponse Content: Values added successfully
```
everytime the value is sent to the server (by default every 1.5s), and you should see these values in real time on the [website](https://smartenv.salviano.xyz).
