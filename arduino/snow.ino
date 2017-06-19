#include <SPI.h>
#include <Ethernet.h>
#include <DHT.h>
#include <Wire.h> 
#include <LiquidCrystal_I2C.h>

//network config
IPAddress ip(192, 168, 1, 182);
byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };
byte mydns[] = {8, 8, 8, 8};
byte gateway[] = { 192, 168, 1, 254 };               
byte subnet[] = { 255,255,255,0 }; 

//server config
IPAddress server(192,168,1,2);
int port = 8000;

//connection config
EthernetClient client;
unsigned long lastConnectionTime = 0;
const unsigned long postingInterval = 10L * 1000L; // delay between updates, in milliseconds

//sensor config
#define DHT11_PIN 5
#define DHTTYPE DHT11  
DHT dht(DHT11_PIN, DHTTYPE);

//lcd config
LiquidCrystal_I2C lcd(0x27, 16, 2);
unsigned long lastPrintTime = 0;
const unsigned long printingInterval = 10L * 1000L; // delay between updates, in milliseconds

//module config
String numero_serial = "xpto666";

void setup() {
  Serial.begin(9600);
  
  // give the ethernet module time to boot up:
  delay(1000);

  Ethernet.begin(mac, ip);
  Serial.print("My IP address: ");
  Serial.println(Ethernet.localIP());

  lcd.begin();
  lcd.backlight();
}

void loop() {
  if (client.available()) {
    char c = client.read();
    Serial.write(c);
  }

  if (millis() - lastConnectionTime > postingInterval) {
    httpRequest();
  }

  if (millis() - lastPrintTime > printingInterval) {
    printLcd();
  }
}

void httpRequest() {
  client.stop();

  Serial.println("connecting...");

  String requestData = getRequestData();
  
  if (client.connect(server, port) && requestData != "") {
    client.println("POST /api/leitura HTTP/1.1");
    client.println("Host: 192.168.1.2");
    client.println("User-Agent: Arduino/1.0");
    client.println("Connection: close");
    client.println("Content-Type: application/x-www-form-urlencoded");
    client.print("Content-Length: ");
    client.println(requestData.length());
    client.println();
    client.println(requestData);
    
    // note the time that the connection was made:
    lastConnectionTime = millis();

    Serial.println("POST /api/leitura HTTP/1.1");
    Serial.println("Host: 192.168.1.2");
    Serial.println("User-Agent: Arduino/1.0");
    Serial.println("Connection: close");
    Serial.println("Content-Type: application/x-www-form-urlencoded");
    Serial.print("Content-Length: ");
    Serial.println(requestData.length());
    Serial.println();
    Serial.println(requestData);
  } else {
    // if you couldn't make a connection:
    Serial.println("connection failed");
  }
}

String getRequestData(){
  float humidade = dht.readHumidity();
  float temperatura = dht.readTemperature();

  if(isnan(humidade) || isnan(temperatura)){
    Serial.println("Erro ao ler do sensor.");
    return "";
  }

  String data = "serial=" + numero_serial + "&humidade=" + humidade + "&temperatura=" + temperatura;

  return data;
}

void printLcd(){
  float humidade = dht.readHumidity();
  float temperatura = dht.readTemperature();

  if(isnan(humidade) || isnan(temperatura)){
    Serial.println("Erro ao ler do sensor.");
    return;
  }
  
  lcd.clear();
  lcd.setCursor (0,0);
  lcd.print("Hum: " + String(humidade));

  lcd.setCursor (0,1);
  lcd.print("Temp: " + String(temperatura));

  lastPrintTime = millis();
}
 

