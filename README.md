=========================Bahasa Indonesia=====================

Halo teman-teman , aku Imanuel dan aku sedang membuat projek untuk skripsi mengenai monitoring peralatan AWS dan ARG yang ada di Jawa Barat dengan protokol MQTT. Feel free and enjoy ya untuk membaca atau mempraktikkannya. Dan aku terima jika ada yang ingin berkolaborasi. :)
Berikut adalah deksripsi mengenai website saya : 

1. Website ini bernama Sipancar (Sistem Pemantauan Cuaca Jawa Barat) yang meliputi monitoring peralatan untuk AWS (Automatic Weather Station) & ARG (Automatic Rain Gauge) pada peralatan Jawa Barat.
   
2. Adapun fitur-fitur dalam websitenya ya :
* 🌍 **Dashboard Peta Interaktif:** Memantau sebaran dan status keaktifan/anomali alat AWS dan ARG secara visual (dibangun dengan Leaflet.js).
  <img width="1001" height="830" alt="Screenshot 2026-03-06 230133" src="https://github.com/user-attachments/assets/a6089c28-18a2-41db-8e00-7bd6e70a8ef3" />

* 📊 **Monitoring Real-Time:** Menampilkan data cuaca terkini (Suhu, Kelembapan, Curah Hujan, Kecepatan Angin, Radiasi Matahari, dan Tegangan Baterai).
  1. ARG
     <img width="932" height="827" alt="image" src="https://github.com/user-attachments/assets/d5d753af-22fe-409f-aee6-10333e0b6526" />
  2. AWS
     <img width="1011" height="834" alt="image" src="https://github.com/user-attachments/assets/8c0c6060-34a3-47a1-9a84-3283b8c4b35e" />

* 🤖 **Sistem Deteksi Anomali & Imputasi AI:** Mendeteksi data sensor yang *error* (Missing, Range, Step check) dan otomatis memulihkannya menggunakan perhitungan Regresi Linear (Y = a + bX).
  <img width="1008" height="835" alt="image" src="https://github.com/user-attachments/assets/542ecf8a-8fb9-48a0-9526-895b1acbf545" />

  
* 📱 **Integrasi Mobile App:** Tersedia aplikasi Android pendamping (dibangun menggunakan Kodular) untuk pemantauan via *smartphone*.
- Login : ![WhatsApp Image 2026-03-06 at 23 06 24](https://github.com/user-attachments/assets/d1e3bc33-9fc4-4bf3-8b92-32dbe7dd34b4)

- Home :![WhatsApp Image 2026-03-06 at 23 06 25](https://github.com/user-attachments/assets/55e569bf-39ec-4771-9548-086ad70c087a)

- Dashboard : ![WhatsApp Image 2026-03-06 at 23 06 25 (1)](https://github.com/user-attachments/assets/e9e8117e-28ab-4d73-836d-ab6cb6f27389)
  1. AWS : ![awsmobile](https://github.com/user-attachments/assets/11f6e138-ea16-46c3-bfe3-2730de3c2f8e)
  2. ARG : ![argmobile](https://github.com/user-attachments/assets/e0fa52cc-cdd3-41f8-9fc6-03966ea00074)

- Imputasi : ![WhatsApp Image 2026-03-06 at 23 06 26](https://github.com/user-attachments/assets/7729b2a1-768a-4091-b55c-0363e34d14cf)

  
* 🔗 **IoT Pipeline:** Menggunakan **Node-RED** sebagai perantara (MQTT/HTTP) untuk menerima data dari alat fisik sebelum masuk ke *database*.

3. Software yang digunakan yaitu : 

**Sisi Web & Backend:**
* [Laravel](https://laravel.com/) (PHP Framework)
* MySQL (Database)
* HTML, CSS, JavaScript (Leaflet.js untuk Peta)

**Sisi IoT & Mobile:**
* Node-RED (Data Flow & MQTT Receiver)
* Kodular (Pembuatan Aplikasi Android / APK)

4. Link untuk Clone saya :
   - ```bash
   git clone [https://github.com/imanuelsianipar/project-mqtt.git](https://github.com/imanuelsianipar/project-mqtt.git)

5. Langkah-langkah untuk mempraktikannya :
   - cd project-mqtt ( buat folder bisa dengan terminal (cmd/vscode/dll)
   - composer install (Install dependencies Laravel:)
   - cp .env.example .env (Copy file .env dan sesuaikan database:)
   - php artisan key:generate (Copy file .env dan sesuaikan database:)
   - php artisan serve (Jalankan server secara lokal )

=========================English Languange=====================



Hello everyone, my name is Imanuel and I am currently working on a thesis project about monitoring AWS and ARG equipment in West Java using the MQTT protocol. Please feel free to read or try it out. I am open to collaboration if anyone is interested. :)
Here is a description of my website:  

1. This website is called Sipancar (West Java Weather Monitoring System), which covers the monitoring of AWS (Automatic Weather Stations) and ARG (Automatic Rain Gauges) equipment in West Java.  
   
2. The features of the website are:
* 🌍 **Interactive Map Dashboard:** Visually monitors the distribution and status of AWS and ARG equipment activity/anomalies (built with Leaflet.js).
* <img width="1001" height="830" alt="Screenshot 2026-03-06 230133" src="https://github.com/user-attachments/assets/a6089c28-18a2-41db-8e00-7bd6e70a8ef3" />
  
* 📊 **Real-Time Monitoring:** Displays current weather data (Temperature, Humidity, Rainfall, Wind Speed, Solar Radiation, and Battery Voltage).
   1. ARG
     <img width="932" height="827" alt="image" src="https://github.com/user-attachments/assets/d5d753af-22fe-409f-aee6-10333e0b6526" />
  2. AWS
     <img width="1011" height="834" alt="image" src="https://github.com/user-attachments/assets/8c0c6060-34a3-47a1-9a84-3283b8c4b35e" />
* 🤖 **Anomaly Detection & AI Imputation System:** Detects problematic sensor data (Missing, Out of range, Step checks) and automatically recovers it using Linear Regression calculations (Y = a + bX).
    <img width="1008" height="835" alt="image" src="https://github.com/user-attachments/assets/542ecf8a-8fb9-48a0-9526-895b1acbf545" />
  
* 📱 **Mobile Application Integration:** Companion Android application (built using Kodular) available for monitoring via smartphone.
- Login : ![WhatsApp Image 2026-03-06 at 23 06 24](https://github.com/user-attachments/assets/d1e3bc33-9fc4-4bf3-8b92-32dbe7dd34b4)

- Home :![WhatsApp Image 2026-03-06 at 23 06 25](https://github.com/user-attachments/assets/55e569bf-39ec-4771-9548-086ad70c087a)

- Dashboard : ![WhatsApp Image 2026-03-06 at 23 06 25 (1)](https://github.com/user-attachments/assets/e9e8117e-28ab-4d73-836d-ab6cb6f27389)
  1. AWS : ![awsmobile](https://github.com/user-attachments/assets/11f6e138-ea16-46c3-bfe3-2730de3c2f8e)
  2. ARG : ![argmobile](https://github.com/user-attachments/assets/e0fa52cc-cdd3-41f8-9fc6-03966ea00074)

- Imputasi : ![WhatsApp Image 2026-03-06 at 23 06 26](https://github.com/user-attachments/assets/7729b2a1-768a-4091-b55c-0363e34d14cf)
* 🔗 **IoT Pipeline:** Uses Node-RED as an intermediary (MQTT/HTTP) to receive data from physical devices before storing it in the database.

3. The software used is: 

**Web & Backend:**
* [Laravel](https://laravel.com/) (PHP Framework)
* MySQL (Database)
* HTML, CSS, JavaScript (Leaflet.js for Maps)

**IoT & Mobile:**
* Node-RED (Data Flow & MQTT Receiver)
* Kodular (Android Application Development / APK)


4. Link to clone my project:
   - git clone [https://github.com/imanuelsianipar/project-mqtt.git](https://github.com/imanuelsianipar/project-mqtt.git)

6. Steps to implement it:
   - cd project-mqtt (create a folder using the terminal (cmd/vscode/etc.)
   - composer install (Install Laravel dependencies:)
   - cp .env.example .env (Copy the .env file and adjust the database:)
   - php artisan key:generate (Copy the .env file and adjust the database:)
   - php artisan serve (Run the server locally)





