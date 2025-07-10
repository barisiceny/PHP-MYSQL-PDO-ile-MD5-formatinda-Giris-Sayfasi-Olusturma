# PHP-MYSQL-PDO-ile-MD5-formatinda-Giris-Sayfasi-Olusturma
## Merhaba,

Bu Projede, PHP MYSQL (PDO) Giriş işlemlerinde bulunabilecek tüm özelliklere sahiptir.
#### Proje İçeriğimiz

* Şifreleri MD5 formatıyla şifreleyin (Ekle, Düzenle'de mevcuttur)

* "Beni Hatırla" Yapmak

* 2 Girişte şifreleri kontrol etme

* SweatAlert ile uyarılar

* Kullanıcı Silme

* Kullanıcı Ekle

* Kullanıcıyı Düzenleme

* Sayfayı açtığınızda, önce giriş sayfasına yönlendirin

## Giriş Sayfası (login.php)

* BENİ Hatırla Bölümü
![alt text](https://github.com/barisiceny/PHP-MYSQL-PDO-ile-MD5-formatinda-Giris-Sayfasi-Olusturma/blob/main/img/ss/user-login.png?raw=true)

#### SweatAlert ile uyarı
![alt text](https://github.com/barisiceny/PHP-MYSQL-PDO-ile-MD5-formatinda-Giris-Sayfasi-Olusturma/blob/main/img/ss/user-login-alert.png?raw=true)

## Ana Sayfa (index.php)
* Listeleme Verileri
* Ekleme, Düzenleme, Silme Işlemlerini Uygulamak

![alt text](https://github.com/barisiceny/PHP-MYSQL-PDO-ile-MD5-formatinda-Giris-Sayfasi-Olusturma/blob/main/img/ss/user-home.png?raw=true)

## Kullanıcı ADD Sayfası (useradd.php)

![alt text](https://github.com/barisiceny/PHP-MYSQL-PDO-ile-MD5-formatinda-Giris-Sayfasi-Olusturma/blob/main/img/ss/user-add.png?raw=true)

### SweatAlert ile uyarı

![alt text](https://github.com/barisiceny/PHP-MYSQL-PDO-ile-MD5-formatinda-Giris-Sayfasi-Olusturma/blob/main/img/ss/user-add-alert.png?raw=true)

## Kullanıcı Güncelleme Sayfası (userupdate.php)

![alt text](https://github.com/barisiceny/PHP-MYSQL-PDO-ile-MD5-formatinda-Giris-Sayfasi-Olusturma/blob/main/img/ss/user-update.png?raw=true)

#### SweatAlert ile uyarı

![alt text](https://github.com/barisiceny/PHP-MYSQL-PDO-ile-MD5-formatinda-Giris-Sayfasi-Olusturma/blob/main/img/ss/user-update-alert.png?raw=true)
![alt text](https://github.com/barisiceny/PHP-MYSQL-PDO-ile-MD5-formatinda-Giris-Sayfasi-Olusturma/blob/main/img/ss/user-update-alert2.png?raw=true)

## SweatAlert ile uyarı (userdelete.php)
![alt text](https://github.com/barisiceny/PHP-MYSQL-PDO-ile-MD5-formatinda-Giris-Sayfasi-Olusturma/blob/main/img/ss/user-delete.png?raw=true)

## Veritabanı 

![alt text](https://github.com/barisiceny/PHP-MYSQL-PDO-ile-MD5-formatinda-Giris-Sayfasi-Olusturma/blob/main/img/ss/user-database.png?raw=true)

##### Veritabanı Veriler
Gördüğünüz gibi parolamız veritabanında MD5 formatındadır. 

![alt text](https://github.com/barisiceny/PHP-MYSQL-PDO-ile-MD5-formatinda-Giris-Sayfasi-Olusturma/blob/main/img/ss/user-database-data.png?raw=true)

## Kaynak Kodları

* İlgili açıklamalar kaynak kodundadır

#### fonc.php (Veritabanı Ayarlarımız)

```
<?php
$host = '127.0.0.1';
$dbname = 'loginpdo';
$username = 'root';
$password = '';
$charset = 'utf8';
$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_PERSISTENT => false,
    PDO::ATTR_EMULATE_PREPARES => false,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,   
];
try {
    $connect = new PDO($dsn, $username, $password, $options);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connect error: ' . $e->getMessage();
    exit;
}
?>
```
