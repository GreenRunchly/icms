# ICMS

ICMS adalah CMS Minimal untuk aplikasi berbahasa PHP agar lebih mudah dalam implementasi kode, yang mana ini mirip dengan Wordpress.

## Instalasi

Download [release  icms](https://github.com/GreenRunchly/icms/releases/download/latest/icms.zip) untuk memulai, taruh pada folder yang diinginkan dan extract zip tersebut, ingat bahwa icms akan melakukan update secara otomatis, jadi tidak perlu melakukan extract berkali-kali.

Ingat! updater akan menimpah file berikut

- app-theme/example/core/db.php
- app-theme/example/core/function.php
- app-theme/example/core/module.php
- app-theme/example/core/pages.php
- app-theme/example/core/urlhandler.php
- app-theme/example/404.php
- app-theme/example/index.php
- app-theme/index.php
- app-theme/README.md
- icms-function.php
- icms-load.php
- icms-themehandler.php
- icms-update.php
- index.php
- .htaccess.bak

jadi harap tidak melakukan perubahan pada file tersebut.


## Pemakaian
Agar aplikasimu dapat diimplementasikan, pertama-tama buat duplikasi folder "example" didalam folder "app-theme" dan mengubahnya menjadi sesuai keinginan.

Kemudian taruh aplikasi mu didalam folder yang baru saja di duplikasi.

Sebelum lanjut, kita harus mengetahui apa saja maksud file yang ada didalam folder theme

| File | Fungsi |
| ------ | ------ |
| index.php | Halaman utama dari aplikasi |
| 404.php | Halaman error custom jika tidak ada apa yang dicari |
| core/db.php | Ini adalah file untuk konfigurasi agar aplikasi dapat terhubung dengan database |
| core/function.php | File function khusus untuk aplikasi pada theme |
| core/module.php | File khusus aktif/non-aktifkan module untuk aplikasi jika membutuhkan library atau semacamnya |
| core/pages.php | File ini bisa dibilang untuk controller url, jadi ini sebagai permalink untuk menentukan url yang akan menampilkan halaman yang dimaksud. |
| core/urlhandler.php | File ini dikhususkan jika ingin melakukan sesuatu pada url saat halaman pages tidak diset, maka akan di arahkan ke sini dan bisa di manipulasi agar bisa menampilkan yang lain. |

### core/pages.php
Agar file aplikasi mu dapat diakses, bisa set melalui file pages.php pada theme core, misalnya 
```
$icms_pages = array(
	"" 	=>	"index.php",
	"dashboard/profile"  =>  "profile-user.php"
);
```
maka profile-user.php dapat diakses dengan memasukan url berikut pada browser 
```
https://my.app/dashboard/profile
```

### core/db.php
Agar file aplikasi mu dapat terhubung dengan database, bisa set melalui file db.php pada theme core, misalnya 
```
define('ICMS_DB_NAME', 'nama_db'); /// Masukan nama database
define('ICMS_DB_USER', 'user_db'); /// User database
define('ICMS_DB_USER_PASS', 'pass123'); /// User password akun database
define('ICMS_DB_HOST', 'localhost'); /// Server db
```
maka semua halaman akan selalu terhubung ke database dan dapat melakukan penarikan data dengan function bawaan berikut
```
app_db_select( table, key, value );
```
| Parameter | Format |
| ------ | ------ |
| table | string |
| key | array |
| value | array |

Contoh pemakaiannya 

```
print_r( 
    app_db_select( "ieulink_pengguna", [ "id" ], [ 1 ] )
);
```


## Kontribusi

Permintaan pull diperbolehkan. Untuk perubahan besar, buka issue terlebih dahulu
untuk mendiskusikan apa yang ingin diubah.

Harap pastikan untuk memperbarui tes yang sesuai.
