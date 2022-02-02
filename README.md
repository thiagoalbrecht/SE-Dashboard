# SE-Dashboard

Smart Environments Project Dashboard - Team 20

This web app was created with Vue.js (mainly) for the frontend and PHP for the backend, and uses HTTP Polling to insert and retrieve the water height values to/from a database. The project uses a Processing sketch to retrieve data from the Arduino and post them to the server's database, but anything capable of sending a HTTP POST Request can be used, including an Arduino with an Ethernet Shield or Wi-Fi module.


Website: https://smartenv.salviano.xyz

# Getting Started

### Deploying website

You can deploy this repository to your webserver or download it and manually upload the files there (you do not need to upload the Sketch folder).

#### Credentials setup:

You will have to set up your MySQL database credentials and create a password to allow the Processing sketch to send the values to the server. These credentials can be set up in the `secret/credentials.php` file.

#### Create a database:

Create the database table for this project by running the SQL query below (you may paste this in your phpMyAdmin > SQL):
```sql
START TRANSACTION;
--
-- Table structure for table `waterlevel`
--
CREATE TABLE `waterlevel` (
  `id` int(11) NOT NULL,
  `sensor_value_1` int(11) NOT NULL,
  `sensor_value_2` int(11) NOT NULL,
  `sensor_value_3` int(11) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp()
) DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for table `waterlevel`
--
ALTER TABLE `waterlevel`
  ADD PRIMARY KEY (`id`);
  
--
-- AUTO_INCREMENT for table `waterlevel`
--
ALTER TABLE `waterlevel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;
```

#### Edit app.js:

Finally, you also have to change the `rootURL` value in the first line of the `app.js` code:

```javascript
var rootURL = "https://example.com"; 
// Change this to the address of where your website is hosted (including any paths), without a trailing slash, as shown here.
```

### Setting up the Arduino + Processing
To sync the data from the Arduino to the website, you may use the "SE_CloudSender.pde" Processing sketch.

The code for both Arduino and Processing are located in the 'Sketch' folder in this repository. 

In Processing, first import the [HTTP Requests for Processing](https://github.com/runemadsen/HTTP-Requests-for-Processing) library

Input the password you created in the constant `ProcessingPassword` in `secret/credentials.php` (line 5):
```processing
String password = "YOUR_PASSWORD_HERE";
```

Change the `PostRequest` value to the address of the `put.php` file (line 16):
```processing
PostRequest post = new PostRequest("https://example.com/put.php");
```

You may adjust the serial port of the Arduino in this line (located in *void setup()*), in case the code doesn't work the first time:
```processing
port = new Serial(this, Serial.list()[0], 9600);
                                      ↑
```
Make sure the Arduino is connected and running the code from the Project_Water_Height.ino, also in the Sketch folder.

Run the Processing sketch and check the processing console output. You should see a
```
Server Response: Values X, Y, Z posted
```
every time the value is sent to the server (by default every 1.5s), and you should see these values in real time on the website.

# Dependencies

This project uses a few external libraries/resources, listed below. Most of them are already bundled with the project.

### Web app

- Vue.js (https://vuejs.org/) - Frontend JavaScript Framework
- Axios (https://github.com/axios/axios) - Handles HTTP requests in the browser
- ApexCharts.js (https://apexcharts.com/) - Interactive Charts Library
- Bootstrap 5 (https://getbootstrap.com/) - CSS Framework used to design the webpage
- Font Awesome (https://github.com/FortAwesome/Font-Awesome) - Icons library

### Processing

- Serial - Sending and receiving data from the Arduino using the serial protocol
- HTTP Requests for Processing (https://github.com/runemadsen/HTTP-Requests-for-Processing) - Handles HTTP requests in Processing (you will have to install this library first)
