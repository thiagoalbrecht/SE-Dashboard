#define ultraSonic1 A0
#define ultraSonic2 A1
#define ultraSonic3 A2
int waterHeight1;
int waterHeight2;
int waterHeight3;


void setup() {
  Serial.begin(9600);
  pinMode(ultraSonic1, INPUT);
  pinMode(ultraSonic2, INPUT);
  pinMode(ultraSonic3, INPUT);
}

void loop() {
  waterHeight1 = map(analogRead(ultraSonic1), 0, 850, 100, 0); //The height becomes a value between 0 and 100, with 0 being no water and 100 the highest water level
  waterHeight2 = map(analogRead(ultraSonic2), 0, 850, 100, 0);
  waterHeight3 = map(analogRead(ultraSonic3), 0, 850, 100, 0);

  if(waterHeight1 < 0){
    waterHeight1 = 0;
    }
   if(waterHeight2 < 0){
    waterHeight2 = 0;
    }
   if(waterHeight3 < 0){
    waterHeight3 = 0;
    }
   if(analogRead(ultraSonic1) == 1023){
    waterHeight1 = 100;  
    }
   if(analogRead(ultraSonic2) == 1023){
    waterHeight2 = 100;  
    }
   if(analogRead(ultraSonic3) == 1023){
    waterHeight3 = 100;  
    }

  Serial.print(waterHeight1);
  Serial.print("|");
  Serial.print(waterHeight2);
  Serial.print("|");
  Serial.print(waterHeight3);
  Serial.print(",");

  delay(500);
}
