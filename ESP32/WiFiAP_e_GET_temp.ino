#include <Arduino.h>
#include <WiFiManager.h>    
#include <HTTPClient.h>   
#include <Wire.h>
#include <Adafruit_Sensor.h>
#include <Adafruit_BME280.h>

#define ADC_UMIDO 2031
#define ADC_SECO  4066

const int PinoSensor = 34;
 int ValorUmidadeRAW = 0;
 int umidade_solo = 0;

 #ifdef __cplusplus
  extern "C" {
 #endif

  uint8_t temprature_sens_read();

#ifdef __cplusplus
}
#endif

uint8_t temprature_sens_read();

WebServer server(80);
WiFiManager wm;

unsigned int id_sensor, temperatura, temp_chip, umidade, pressao, altitude;

#define PIN_RESET_BUTTON 4        
int RESET = 0; 



#define SEALEVELPRESSURE_HPA (1013.25)

Adafruit_BME280 bme;


const char* serverName = "http://mbruno.tech/alimentador/esp32/insere_dados.php";

String sensorName = "BME280";
String sensorLocation = "Office";

#define SEALEVELPRESSURE_HPA (1013.25)
int Variavel2 = 20;
int Variavel1 = 10;

 
    HTTPClient http;
    

void setup() {
    // put your setup code here, to run once:
    Serial.begin(115200);
    http.begin(serverName);
    bme.begin(0x76);
    pinMode(PIN_RESET_BUTTON, INPUT);
    //WiFiManager
    //Local intialization. Once its business is done, there is no need to keep it around
    
    //reset saved settings
    //wm.resetSettings();
    
    //Assign fixed IP
    //wifiManager.setAPStaticIPConfig(IPAddress(10,0,1,1), IPAddress(10,0,1,1), IPAddress(255,255,255,0));

    //Try to connect WiFi, then create AP
    wm.autoConnect("Composteira", "12345678");
    
    //the library is blocking. Once connected, the program continues
    Serial.println("Composteira conectou-se ao ponto de acesso!");
    

    http.addHeader("Content-Type", "application/x-www-form-urlencoded");
    Variavel2++;
    Variavel1++;
   
    String httpRequestData = "token=" +  String(Variavel1) + "&field1=" +  String(Variavel2)
                          + "";
    Serial.print("httpRequestData: ");
    Serial.println(httpRequestData);
    int httpResponseCode = http.POST(httpRequestData);
    
    delay(100); 
}


void loop() {
    server.handleClient();
    
    RESET = digitalRead(PIN_RESET_BUTTON);
    if( RESET == HIGH) {                                 
      Serial.println("Erase settings and restart ...");
      delay(1000);
      wm.resetSettings();  
      ESP.restart();  
    }

 delay(10000);

 http.addHeader("Content-Type", "application/x-www-form-urlencoded");
   
   
    // *100 para tirar o ponto decimal
    id_sensor     = 1;
    temperatura   = bme.readTemperature()*100;
    temp_chip     = ((temprature_sens_read() - 32) / 1.8)*100; 
    umidade       = bme.readHumidity()*100;
    pressao       = (bme.readPressure() / 100.0F)*100;
    altitude      = (bme.readAltitude(SEALEVELPRESSURE_HPA))*100;

    ValorUmidadeRAW = analogRead(PinoSensor);
    
    umidade_solo  = 100+(100*(((float)ADC_UMIDO - (float)(ValorUmidadeRAW))/(ADC_SECO-ADC_UMIDO)));
    if(umidade_solo <= 0){
      umidade_solo = 0;
    }
   
    String httpRequestData =  "id_sensor=" +  String(id_sensor) + 
                              "&temperatura=" +  String(temperatura) +
                              "&temp_chip=" +  String(temp_chip) +
                              "&umidade=" +  String(umidade) +
                              "&pressao=" +  String(pressao) +
                              "&altitude=" +  String(altitude) +
                              "&solo=" +  String(umidade_solo) +
                          + "";
    Serial.print("httpRequestData: ");
    Serial.println(httpRequestData);
    int httpResponseCode = http.POST(httpRequestData);

   // Serial.print((temprature_sens_read() - 32) / 1.8);
   // Serial.println(" C");
    
    
}
