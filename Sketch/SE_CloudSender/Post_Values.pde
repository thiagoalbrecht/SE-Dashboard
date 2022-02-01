void postValues(String[] sensorValues) {
  if (!kill) {
    post.addData("pw", password);
    post.addData("sensorvalue1", sensorValues[0]);
    post.addData("sensorvalue2", sensorValues[1]);
    post.addData("sensorvalue3", sensorValues[2]);
    post.send();
    println("Server Response: " + post.getContent());
    switch (int(post.getHeader("xx-status"))) {
    case 201:
      setResponse("Last values\nadded successfully", "green");
      break;
    case 401:
      setResponse("Password incorrect\ncould not authenticate", "red");
      kill = true;
      break;
    case 400:
      setResponse("Bad request", "red");
      kill= true;
      break;
    default:
    setResponse("Something went wrong\nTrying again...", "yellow");
    }
  }
}

void setResponse(String passmessage, String passtxtcolour) {
  message = passmessage;
  txtcolour = passtxtcolour;
}

void outputResponse() {
  switch (txtcolour) {
  case "red":
    fill(200, 0, 0);
    break;
  case "green":
    fill(122, 255, 33);
    break;
  case "yellow":
    fill(255, 255, 0);
    break;
  default:
    fill(255);
    break;
  }
  textAlign(CENTER);
  textSize(32);
  text(message, 200, 85);
}
