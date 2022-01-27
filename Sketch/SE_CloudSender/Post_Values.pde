void postValues(String[] sensorValues) {
  post.addData("sensorvalue1", sensorValues[0]);
  post.addData("sensorvalue2", sensorValues[1]);
  post.addData("sensorvalue3", sensorValues[2]);
  post.send();
  println("Reponse Content: " + post.getContent());
}
