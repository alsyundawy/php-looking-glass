# Alsyundawy PHP Looking Glass

![License](https://img.shields.io/badge/license-MIT-blue.svg) ![PHP](https://img.shields.io/badge/php-%3E%3D8.1-777bb4.svg)
[![Latest Version](https://img.shields.io/github/v/release/alsyundawy/php-looking-glass)](https://github.com/alsyundawy/php-looking-glass/releases)
[![Maintenance Status](https://img.shields.io/maintenance/yes/9999)](https://github.com/alsyundawy/php-looking-glass/)
[![License](https://img.shields.io/github/license/alsyundawy/php-looking-glass)](https://github.com/alsyundawy/php-looking-glass/blob/master/LICENSE)
[![GitHub Issues](https://img.shields.io/github/issues/alsyundawy/php-looking-glass)](https://github.com/alsyundawy/php-looking-glass/issues)
[![GitHub Pull Requests](https://img.shields.io/github/issues-pr/alsyundawy/php-looking-glass)](https://github.com/alsyundawy/php-looking-glass/pulls)
[![Donate with PayPal](https://img.shields.io/badge/PayPal-donate-orange)](https://www.paypal.me/alsyundawy)
[![Sponsor with GitHub](https://img.shields.io/badge/GitHub-sponsor-orange)](https://github.com/sponsors/alsyundawy)
[![GitHub Stars](https://img.shields.io/github/stars/alsyundawy/php-looking-glass?style=social)](https://github.com/alsyundawy/php-looking-glass/stargazers)
[![GitHub Forks](https://img.shields.io/github/forks/alsyundawy/php-looking-glass?style=social)](https://github.com/alsyundawy/php-looking-glass/network/members)
[![GitHub Contributors](https://img.shields.io/github/contributors/alsyundawy/php-looking-glass?style=social)](https://github.com/alsyundawy/php-looking-glass/graphs/contributors)

## Statistik Bintang

[![Stargazers over time](https://starchart.cc/alsyundawy/php-looking-glass.svg?variant=dark)](https://starchart.cc/alsyundawy/php-looking-glass)

**Sebuah alat Looking Glass PHP yang profesional, ringan, dan terdiri dari satu file, dirancang untuk diagnostik jaringan. Sepenuhnya kompatibel dengan IPv4 dan IPv6, dilengkapi antarmuka modern yang responsif (Mode Gelap/Terang) serta memanfaatkan utilitas sistem standar.**

![looking-glass](/php-looking-glass.png)

## Fitur

- **Diagnostik Jaringan**: Ping, Traceroute, MTR (My Traceroute), dan Host (Pencarian DNS).
- **Pengujian Performa**:
  - **Iperf3**: Dukungan mode TCP, UDP, dan Reverse.
  - **Uji Unduhan**: Unduhan file biner yang dapat dikustomisasi.
- **Antarmuka Modern**:
  - Desain responsif penuh (Mobile hingga 4K).
  - Tombol mode Gelap/Terang.
  - Deteksi IP klien secara real-time.
- **Keamanan**: Sanitasi input ketat untuk mencegah injeksi perintah.
- **Mudah Dipasang**: Satu file PHP, tanpa memerlukan database.

## Persyaratan

- **PHP**: Versi 8.1 atau lebih tinggi.
- **Modul PHP**: `php-cli`, `php-common`, `php-fpm` (jika menggunakan Nginx), `php-json`, `php-mbstring`, `php-xml`.
- **Web Server**: Nginx atau Apache.
- **Utilitas Sistem**: Pengguna web server harus dapat menjalankan perintah berikut:
  - `ping`
  - `traceroute`
  - `mtr`
  - `iperf3`
  - `host` (biasanya bagian dari paket `bind-utils` atau `dnsutils`)

---

## Panduan Instalasi

### 1. Instal Dependensi Sistem melalui Terminal

**Debian/Ubuntu:**

```bash
sudo apt-get update
sudo apt-get install php-cli php-fpm php-json php-common php-mbstring php-xml ping traceroute mtr-tiny iperf3 dnsutils -y
```

**CentOS/RHEL/AlmaLinux:**

```bash
sudo dnf install php-cli php-fpm php-json php-common php-mbstring php-xml iputils traceroute mtr iperf3 bind-utils -y
```

### 2. Pemasangan

Cukup unduh file `ALSYUNDAWY-LG-GITHUB-2026.php`, ubah nama menjadi `index.php`, lalu unggah ke direktori publik web server Anda (misalnya `/var/www/html/lg/`).

### 3. Konfigurasi Web Server

Untuk memastikan performa, keamanan, dan fungsionalitas yang optimal (terutama untuk unduhan besar dan pengujian yang berjalan lama seperti MTR), silakan gunakan konfigurasi berikut.

#### Opsi A: Nginx + PHP-FPM

Buat server block baru atau ubah yang sudah ada. Konfigurasi ini mencakup **kompresi Gzip**, **Timeout yang Diperpanjang**, **Header Keamanan**, dan **dukungan IPv6**.

```nginx
server {
    # Mendengarkan port 80 untuk IPv4 dan IPv6
    listen 80;
    listen [::]:80;
    
    server_name lg.yourdomain.com;
    root /var/www/html/lg;
    index index.php;

    # =========================================================================
    # PERFORMA & TIMEOUT
    # =========================================================================
    # Izinkan upload/download file besar (Penting untuk Speedtest/Uji Unduhan)
    client_max_body_size 4096M;
    
    # Timeout diperpanjang untuk proses yang berjalan lama (MTR, Traceroute)
    client_header_timeout 86400;
    client_body_timeout 86400;
    fastcgi_read_timeout 86400;
    proxy_read_timeout 86400;

    # =========================================================================
    # HEADER & PENGATURAN KEAMANAN
    # =========================================================================
    server_tokens off;      # Sembunyikan versi Nginx
    autoindex off;          # Nonaktifkan daftar direktori
    http2 on;               # Aktifkan HTTP/2 untuk performa lebih baik

    # Header keamanan
    add_header Vary Accept-Encoding;
    proxy_hide_header Vary;

    # =========================================================================
    # HALAMAN ERROR KUSTOM
    # =========================================================================
    error_page 400 /400.html;
    error_page 401 /401.html;
    error_page 402 /402.html;
    error_page 403 /403.html;
    error_page 404 /404.html;
    error_page 500 /500.html;
    error_page 502 /502.html;
    error_page 503 /503.html;

    # =========================================================================
    # KOMPRESI GZIP
    # =========================================================================
    gzip on;
    gzip_static on;
    gzip_disable "MSIE [1-6]\.(?!.*SV1)";
    gzip_http_version 1.1;
    gzip_min_length 1100;
    gzip_vary on;
    gzip_comp_level 7;
    gzip_proxied any;
    gzip_buffers 128 4k;
    gzip_types
        text/css
        text/javascript
        text/plain
        text/xml
        application/x-javascript
        application/javascript
        application/json
        application/vnd.ms-fontobject
        application/x-font-opentype
        application/x-font-truetype
        application/x-font-ttf
        application/xml
        application/font-woff
        application/atom+xml
        application/rss+xml
        application/x-web-app-manifest+json
        application/xhtml+xml
        font/eot
        font/opentype
        font/otf
        image/svg+xml
        image/vnd.microsoft.icon
        image/bmp
        image/png
        image/gif
        image/jpeg
        image/jpg
        image/webp
        image/x-icon
        text/x-component;

    # =========================================================================
    # BLOK LOKASI
    # =========================================================================
    location / {
        try_files $uri $uri/ =404;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        # Sesuaikan path socket dengan versi PHP Anda (misal: php8.1-fpm.sock)
        fastcgi_pass unix:/run/php/php8.1-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }

    # Tolak akses ke file tersembunyi (misal: .htaccess, .git)
    location ~ /\.ht {
        deny all;
    }
}
```

#### Opsi B: Apache + PHP

Pastikan `mod_rewrite`, `mod_deflate`, `mod_headers`, dan `mod_http2` sudah diaktifkan.

```apache
<VirtualHost *:80>
    ServerName lg.yourdomain.com
    DocumentRoot /var/www/html/lg

    # =========================================================================
    # PROTOKOL & KEAMANAN
    # =========================================================================
    # Aktifkan HTTP/2 (Memerlukan mod_http2)
    Protocols h2 http/1.1

    # Sembunyikan versi dan tanda tangan Apache
    ServerTokens Prod
    ServerSignature Off

    # =========================================================================
    # PERFORMA & TIMEOUT
    # =========================================================================
    # Izinkan upload/download besar (4096M = 4294967296 bytes)
    LimitRequestBody 4294967296

    # Timeout diperpanjang untuk pengujian yang berjalan lama (MTR/Traceroute)
    # Direktif TimeOut pada Apache (dalam detik)
    TimeOut 86400

    <Directory /var/www/html/lg>
        Options -Indexes +FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    # =========================================================================
    # HALAMAN ERROR KUSTOM
    # =========================================================================
    ErrorDocument 400 /400.html
    ErrorDocument 401 /401.html
    ErrorDocument 402 /402.html
    ErrorDocument 403 /403.html
    ErrorDocument 404 /404.html
    ErrorDocument 500 /500.html
    ErrorDocument 502 /502.html
    ErrorDocument 503 /503.html

    # =========================================================================
    # HEADER
    # =========================================================================
    <IfModule mod_headers.c>
        Header append Vary Accept-Encoding
    </IfModule>

    # =========================================================================
    # KOMPRESI GZIP (mod_deflate)
    # =========================================================================
    <IfModule mod_deflate.c>
        AddOutputFilterByType DEFLATE text/css text/javascript text/plain text/xml
        AddOutputFilterByType DEFLATE application/x-javascript application/javascript application/json
        AddOutputFilterByType DEFLATE application/vnd.ms-fontobject application/x-font-opentype application/x-font-truetype
        AddOutputFilterByType DEFLATE application/x-font-ttf application/xml application/font-woff
        AddOutputFilterByType DEFLATE application/atom+xml application/rss+xml application/x-web-app-manifest+json application/xhtml+xml
        AddOutputFilterByType DEFLATE font/eot font/opentype font/otf
        AddOutputFilterByType DEFLATE image/svg+xml image/vnd.microsoft.icon image/bmp image/x-icon
    </IfModule>
</VirtualHost>
```

### 4. Instalasi SSL (Certbot)

Amankan Looking Glass Anda dengan HTTPS menggunakan Let's Encrypt.

**Instal Certbot:**

*Debian/Ubuntu:*

```bash
sudo apt-get install certbot python3-certbot-nginx python3-certbot-apache -y
```

*CentOS/RHEL:*

```bash
sudo dnf install certbot python3-certbot-nginx python3-certbot-apache -y
```

**Jalankan Certbot:**

*Untuk Nginx:*

```bash
sudo certbot --nginx -d lg.yourdomain.com
```

*Untuk Apache:*

```bash
sudo certbot --apache -d lg.yourdomain.com
```

Ikuti instruksi di layar untuk mengonfigurasi SSL secara otomatis.

### 5. Konfigurasi PHP (`php.ini`)

Pastikan fungsi-fungsi berikut **TIDAK** dinonaktifkan dalam file `php.ini` Anda (direktif `disable_functions`):

- `proc_open`
- `proc_get_status`
- `proc_close`
- `stream_get_contents`

Contoh:

```ini
disable_functions = passthru,shell_exec,system,popen,parse_ini_file,show_source
; hapus proc_open, proc_close, dll. dari daftar
```

### 6. Optimasi Performa PHP

Untuk memastikan kelancaran pengujian jaringan (terutama ukuran unduhan yang ditentukan dan traceroute yang panjang), tambahkan atau ubah baris berikut di konfigurasi `php.ini` atau pool FPM Anda:

```ini
; Tingkatkan waktu eksekusi untuk pengujian yang lama (MTR/Traceroute)
max_execution_time = 300
max_input_time = 300

; Pastikan memori cukup untuk penanganan data besar
memory_limit = 256M

; Nonaktifkan output buffering untuk hasil real-time (opsional tapi disarankan)
output_buffering = Off
zlib.output_compression = Off
```

---

## Konfigurasi Layanan (Iperf3)

Untuk menjaga server Iperf3 tetap berjalan di latar belakang sebagai layanan, buat file unit systemd.

1. **Buat file layanan:**

   ```bash
    sudo nano /etc/systemd/system/iperf3.service
   ```

2. **Tambahkan konten berikut:**

   ```ini
    [Unit]
    Description=Iperf3 Server Service
    After=network.target

    [Service]
    Type=simple
    User=nobody
    ExecStart=/usr/bin/iperf3 -s -p 5201
    Restart=always
    RestartSec=3

    [Install]
    WantedBy=multi-user.target
   ```

3. **Mulai dan aktifkan layanan:**

   ```bash
    sudo systemctl daemon-reload
    sudo systemctl start iperf3
    sudo systemctl enable iperf3
   ```

---

## Konfigurasi Firewall

Anda perlu mengizinkan lalu lintas pada port **80** (HTTP), **443** (HTTPS), dan **5201** (Iperf3).

### Opsi A: UFW (Ubuntu/Debian)

```bash
sudo ufw allow 80/tcp
sudo ufw allow 443/tcp
sudo ufw allow 5201/tcp
sudo ufw reload
```

### Opsi B: Firewalld (CentOS/RHEL/AlmaLinux)

```bash
sudo firewall-cmd --permanent --add-service=http
sudo firewall-cmd --permanent --add-service=https
sudo firewall-cmd --permanent --add-port=5201/tcp
sudo firewall-cmd --reload
```

### Opsi C: Iptables

```bash
sudo iptables -A INPUT -p tcp --dport 80 -j ACCEPT
sudo iptables -A INPUT -p tcp --dport 443 -j ACCEPT
sudo iptables -A INPUT -p tcp --dport 5201 -j ACCEPT
sudo service iptables save
```

---

## Konfigurasi

Buka `index.php` di editor teks dan sesuaikan bagian-bagian berikut agar sesuai dengan detail server dan organisasi Anda.

### 1. Konfigurasi Utama (Wajib)

Temukan bagian `// Hardcoded Looking Glass Tools Configuration` di dekat bagian atas file (~baris 184) dan perbarui nilainya:

```php
// Hardcoded Looking Glass Tools Configuration
$ipv4 = 'lg.yourdomain.com';              // Alamat IPv4 server atau hostname Anda
$ipv6 = 'lg.yourdomain.com';              // Alamat IPv6 server atau hostname Anda (kosongkan '' jika tidak tersedia)
$siteName = 'LOOKING GLASS NETWORK TOOLS'; // Nama situs/perusahaan Anda
$siteUrl = 'https://lg.yourdomain.com';    // URL Looking Glass Anda
$siteUrlv4 = 'https://lg.yourdomain.com';  // URL khusus IPv4 untuk uji unduhan
$siteUrlv6 = 'https://lg.yourdomain.com';  // URL khusus IPv6 untuk uji unduhan
$serverLocation = 'JAKARTA - INDONESIA';   // Lokasi server Anda

// Port Iperf
$iperfport = '5201';                       // Port Iperf3 (default: 5201)

// File uji
$testFiles = array('250MB', '500MB', '1GB'); // Ukuran file uji unduhan (file harus ada di direktori yang sama)
```

### 2. Informasi Kontak Header

Temukan bagian `<header class="header">` (~baris 641) dan perbarui detail kontak:

| Item | Yang perlu diubah |
| ------ | ------------------- |
| Nomor telepon | `+62-812-6969-6969` (muncul di header desktop dan mobile) |
| Alamat email | `info@alsyundawy.com` (tautan mailto) |
| Nomor WhatsApp | `6281269696969` di tautan `wa.me/` |
| URL Website | `https://www.alsyundawy.com` |

### 3. Tautan Navigasi

Temukan bagian `<nav class="main-nav">` (~baris 680) dan perbarui tautan:

| Item | Yang perlu diubah |
| ------ | ------------------- |
| Tautan WhatsApp | `https://wa.me/62-812-6969-6969` |
| Tautan Telegram | `https://t.me/alsyundawy` |
| Tautan GitHub | `https://github.com/alsyundawy` |
| Tautan Website | `https://www.alsyundawy.com` |
| Email Kontak | `mailto:info@alsyundawy.com` |

### 4. Data Terstruktur JSON-LD (SEO)

Temukan bagian `JSON-LD via json_encode()` (~baris 440) dan perbarui data organisasi:

| Item | Yang perlu diubah |
| ------ | ------------------- |
| Nama organisasi | `ALSYUNDAWY IT SOLUTION` (muncul di `$appSchema`, `$websiteSchema`, `$orgSchema`) |
| URL organisasi | `https://alsyundawy.com` |
| Nomor telepon | `+62-812-6969-6969` |
| Email NOC | `noc@alsyundawy.com` |
| Email Abuse | `abuse@alsyundawy.com` |
| Nomor AS | `AS696969` dan `696969` (muncul di URL PeeringDB, BGP.tools dan identifier) |
| Alamat kantor | Alamat pos lengkap di `$orgSchema` |
| URL Logo | `https://alsyundawy.com/logo.png` |

### 5. Footer

Temukan bagian `<footer class="site-footer">` (~baris 989) dan perbarui:

| Item | Yang perlu diubah |
| ------ | ------------------- |
| Nama perusahaan | `ALSYUNDAWY IT SOLUTION` |
| Nomor AS | `AS696969` (di teks hak cipta dan tautan info) |
| Kredit desainer | `HARRY DERTIN SUTISNA ALSYUNDAWY` |
| Tautan info | URL RIPESTAT, HE.NET, BGP.Tools, ROBTEX, PEERINGDB, IPinfo, ASRank (ganti `696969` dengan ASN Anda) |

### 6. Tautan Media Sosial

Temukan bagian `<div class="social-links">` di footer (~baris 1013) dan perbarui semua URL media sosial:

| Platform | URL yang perlu diubah |
| ---------- | ----------------------- |
| GitHub | `https://github.com/alsyundawy` |
| LinkedIn | `https://linkedin.com/alsyundawy` |
| Twitter/X | `https://twitter.com/alsyundawy` |
| Facebook | `https://facebook.com/alsyundawy` |
| Instagram | `https://instagram.com/harry.ds.alsyundawy` |
| YouTube | `https://youtube.com/alsyundawy` |
| TikTok | `https://tiktok.com/alsyundawy` |
| Threads | `https://threads.net/alsyundawy` |
| Discord | `https://discord.gg/alsyundawy` |
| Telegram | `https://telegram.org/alsyundawy` |
| WhatsApp | `https://wa.me/+62-812-6969-6969` |

## Kustomisasi Gambar dan Logo

Anda dapat menyesuaikan logo dan gambar latar belakang dengan mengganti file berikut di direktori yang sama dengan skrip:

1. **Logo**: `lg-logo.webp` (Tinggi yang disarankan: ~36px)
2. **Latar Belakang**: `hero-lg.webp` (Latar belakang untuk header, disarankan format webp terkompresi)

Pastikan file-file ini dapat diakses oleh pengguna web server.

### Membuat File Dummy untuk Uji Unduhan

Anda dapat membuat file dummy untuk uji kecepatan unduhan menggunakan perintah `dd` di terminal. Navigasi ke direktori web server Anda (misal: `/var/www/html/lg/`) dan jalankan:

**File 250MB:**

```bash
dd if=/dev/zero of=250MB.bin bs=1M count=250 status=progress
```

**File 500MB:**

```bash
dd if=/dev/zero of=500MB.bin bs=1M count=500 status=progress
```

**File 1GB:**

```bash
dd if=/dev/zero of=1GB.bin bs=1M count=1024 status=progress
```

> **Catatan:** Pastikan nama file sesuai dengan nilai pada array konfigurasi `$testFiles` di skrip PHP.

## Pemecahan Masalah

### 1. Error 404 Not Found

- **Nginx**: Pastikan direktif `try_files` ada di blok lokasi Anda.
- **Apache**: Pastikan `mod_rewrite` diaktifkan dan dukungan `.htaccess` aktif (`AllowOverride All`).

### 2. Error 500 Internal Server Error

- Periksa log error web server (`/var/log/nginx/error.log` atau `/var/log/apache2/error.log`).
- Pastikan semua ekstensi PHP yang diperlukan sudah terinstal.
- Periksa izin akses: Pengguna web server (`www-data` atau `apache`) harus memiliki akses baca ke skrip.

### 3. "Command not found" atau Output Kosong

- Verifikasi bahwa `ping`, `traceroute`, `mtr`, dan lainnya sudah terinstal (`which ping`).
- Periksa `php.ini` untuk memastikan `proc_open` dan `proc_get_status` TIDAK ada di `disable_functions`.

### 4. Iperf3 Connection Refused

- Pastikan layanan Iperf3 berjalan: `sudo systemctl status iperf3`.
- Periksa pengaturan firewall untuk memastikan port 5201 terbuka.
- Verifikasi IP server pada konfigurasi PHP sesuai dengan IP publik Anda yang sebenarnya.

---

## Catatan Perubahan

### v1.0.3 - 2026-03-05

- Memperbaiki variabel `$script_name` yang tidak terdefinisi; sekarang menggunakan `$_SERVER['SCRIPT_NAME']`.
- Memperbaiki format `date()` yang salah dari `'YY-mm-dd'` menjadi `'Y-m-d'` (ISO 8601).
- Memperbaiki skema `https://` yang hilang pada tag preconnect `cdnjs.cloudflare.com`.
- Memperbaiki kesalahan sintaks JavaScript: selektor jQuery `$((html,body))` yang tidak valid.
- Meningkatkan buffer `fread()` dari 8192 menjadi 16384 untuk output streaming yang lebih cepat.
- Menghapus entri changelog duplikat dan baris kosong di komentar dokumen.
- Tinjauan dan optimasi kode secara menyeluruh.

### v1.0.2 - 2026-02-18

- Memperbarui latar belakang hero di mode terang agar sesuai dengan gaya mode gelap.
- Memperbarui `lg-logo.webp` dan `hero-lg.webp`.
- Optimasi minifikasi CSS dan JS.

### v1.0.1 - 2026-02-17

- Menerapkan Pemeriksaan Validitas Sesi (Token CSRF) pada permintaan POST.
- Menambahkan penanganan error dwibahasa (ID/EN) untuk sesi yang kedaluwarsa.
- Peningkatan dan optimasi gambar webp.
- Peningkatan keamanan dan optimasi.

### v1.0.0 - 2026-02-16

- Rilis Awal.
- Fungsionalitas Looking Glass lengkap dengan tata letak 3-kolom yang dioptimalkan.
- Integrasi fitur Iperf3 dan Uji Unduhan.

---

## Donasi

Anda bebas untuk mengubah dan mendistribusikan skrip ini untuk keperluan Anda.

Jika Anda merasa terbantu dan ingin mendukung proyek ini, pertimbangkan untuk berdonasi melalui <https://www.paypal.me/alsyundawy>. Terima kasih atas dukungannya!

Jika Anda merasa terbantu dan ingin mendukung proyek ini, pertimbangkan untuk berdonasi melalui QRIS. Terima kasih atas dukungannya!

![Donasi QRIS](https://github.com/user-attachments/assets/a0126f28-6dde-43da-ba14-d7c9a27de0df)

## Lisensi

## Lisensi MIT - Hak Cipta (c) 2026 Alsyundawy IT Solution

![Alt](https://repobeats.axiom.co/api/embed/78ddb5f1a231029b742cc467a74bcce400941d0f.svg "Repobeats analytics image")
