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

#### login.php (Giriş Sayfası)
* "Kullanıcılar" ve "şifreler" verilerini veritabanından çekiyoruz.

* Daha önce oturum açtıysanız "index.php" sayfasına yönlendirin

```
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>PHP PDO LOGİN</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/all.min.css">
	
	<script src="js/jquery-3.4.1.min.js"></script>	
	<script src="js/bootstrap.min.js"></script>	
	<script src="js/login.js"></script>	    
	<style>
		body {background-color:#343a40;}
	</style>
</head>
<body>
	<?php
session_start(); //Oturumu başlattık
include("fonc.php"); //Veritabanını dahil ettik

//Oturum varsa sayfayı yeniden yönlendiriyoruz.
if (isset($_SESSION["Session"]) && $_SESSION["Session"] == "9876") {
    header("location:index.php");
} //"Beni hatırla" önceden işaretlenirse, Oturum oluşturur ve sayfayı yönlendiririz.
else if (isset($_COOKIE["cookie"])) {
    
    //Kullanıcı adları sorgulanır
    $query = $connect->prepare("select user from users");
    $query->execute();


    //Döngü yardımıyla kullanıcı adlarını tek tek alıyoruz
    while ($result = $query->fetch()) {
        //Belirlediğimiz yapıya uygun bir kullanıcı varsa ona bakarız.
        if ($_COOKIE["cookie"] == md5("aa" . $result['user'] . "bb")) {

            //Oturum oluşturma, buradaki değerleri güvenlik açısından farklı hale getirebilirsiniz. Kullanıcı adını da burada tuttum
            $_SESSION["Session"] = "9876";
            $_SESSION["user"] = $result['user'];

            //index sayfasına yönlendirme
            header("location:index.php");
        }
    }
}
//Giriş formunun doldurulup doldurulmadığını kontrol ediyoruz
if ($_POST) {
    $txtuser = $_POST["txtuser"]; //Kullanıcı adını değişkene atadık
    $txtpassword = $_POST["txtpassword"]; //Şifreyi değişkene atadık
}
?>
 <div class="container py-5">
    <div class="row">
        <div class="col-md-12">
		<div class="col-md-12 text-center mb-5"><a href="https://github.com/barisiceny">
            <img style="height:70%" src="img/logo.png"></a>
			</div>
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <!-- form card login -->
                    <div class="card rounded-0" id="login-form">
                        <div class="card-header">
                            <h3 class="mb-0">Kullanıcı Girişi</h3>
                        </div>
                        <div class="card-body">
                            <form class="form" action="" method="POST">
                                <div class="form-group">
                                    <label for="uname1">Kullanıcı adı</label>
                                    <input type="text" value="<?php echo @$txtuser ?>" class="form-control form-control-lg rounded-0" name="txtuser" id="inputuser" required name="txtpassword">
     
                                </div>
                                <div class="form-group">
                                    <label>Parola</label>
                                    <input type="password" class="form-control form-control-lg rounded-0" id="inputPassword" required name="txtpassword">
                        
                                </div>

                                      <label>
                            <input type="checkbox" ID="cbkremember" name="cbkremember"/>
                            Beni Hatırla
                        	</label>
                        	<br>

                                <button type="submit" class="btn btn-warning btn-lg float-right" ID="btnlogin">Giriş Yap</button> 
                                 <script type="text/javascript" src="js/sweetalert.min.js"></script>
                        <?php
                        //Bir gönderi varsa, yani gönderilirse, onu veritabanından kontrol ederiz.
                        if ($_POST) {
                            //Sorguda kullanıcı adını alıp karşılık gelen bir şifre olup olmadığını görüyoruz.
                            $query = $connect->prepare("select password from users where user=:user");
                            $query->execute(array('user' => htmlspecialchars($txtuser)));
                            $result = $query->fetch();//Sorguyu yürütme ve veri alma


                            //Şifreleri md5 ile şifreledim ve başına ve sonuna kendi şifremi ekledim.
                            if (md5("56" . $txtpassword . "23") == $result["password"]) {
                                $_SESSION["Session"] = "9876"; //Oturum oluşturma
                                $_SESSION["user"] = $txtuser;

                                //"Beni hatırla" seçilirse, bir çerez oluştururuz.
                                // Çerezde şifreleyerek kullanıcı adından oluşturdum
                                if (isset($_POST["cbkremember"])) {
                                    setcookie("cookie", md5("aa" . $txtuser . "bb"), time() + (60 * 60 * 24 * 7));
                                }
                                  echo '<script>swal("Başarılı","Başarıyla Oturum Açıldı","success").then((value)=>{ window.location.href = "index.php"}); </script>'; 
                                //Veri ekleme başarılı olursa, sweetalert ile başarılı olduğu yazılır.
                                // Ekleme sorgusu işe yaradıysa index.php sayfasına yönlendirir         


                            } else {
                                //Kullanıcı adı ve şifre doğru girilmezse bir hata mesajı alırız.
                                 echo '<script>swal("Oops","Hata, Lütfen Bilgilerinizi Kontrol Edin","error");</script>'; 
            // Kimlik bulunamazsa veya sorguda bir hata varsa, bir hata yazdırırız.

                            }
                        }
                        ?>

                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>	
</body>
</html>

```

#### login.php ( giriş kontrolü )

```
<button type="submit" class="btn btn-warning btn-lg float-right" ID="btnlogin">Giriş Yap</button> 
                                 <script type="text/javascript" src="js/sweetalert.min.js"></script>
                        <?php
                        //Bir gönderi varsa, yani gönderilirse, onu veritabanından kontrol ederiz.
                        if ($_POST) {
                            //Sorguda kullanıcı adını alıp karşılık gelen bir şifre olup olmadığını görüyoruz.
                            $query = $connect->prepare("select password from users where user=:user");
                            $query->execute(array('user' => htmlspecialchars($txtuser)));
                            $result = $query->fetch();//Sorguyu yürütme ve veri alma


                            //Şifreleri md5 ile şifreledim ve başına ve sonuna kendi şifremi ekledim.
                            if (md5("56" . $txtpassword . "23") == $result["password"]) {
                                $_SESSION["Session"] = "9876"; //Oturum oluşturma
                                $_SESSION["user"] = $txtuser;

                                //"Beni hatırla" seçilirse, bir çerez oluştururuz.
                                // Çerezde şifreleyerek kullanıcı adından oluşturdum
                                if (isset($_POST["cbkremember"])) {
                                    setcookie("cookie", md5("aa" . $txtuser . "bb"), time() + (60 * 60 * 24 * 7));
                                }
                                  echo '<script>swal("Başarılı","Başarıyla Oturum Açıldı","success").then((value)=>{ window.location.href = "index.php"}); </script>'; 
                                //Veri ekleme başarılı olursa, sweetalert ile başarılı olduğu yazılır.
                                // Ekleme sorgusu işe yaradıysa index.php sayfasına yönlendirir         


                            } else {
                                //Kullanıcı adı ve şifre doğru girilmezse bir hata mesajı alırız.
                                 echo '<script>swal("Oops","Hata, Lütfen Bilgilerinizi Kontrol Edin","error");</script>'; 
            // Kimlik bulunamazsa veya sorguda bir hata varsa, bir hata yazdırırız.

                            }
                        }
                        ?>
```

### index.php (Sayfayı açtığınızda, önce giriş sayfasına yönlendirin)

* <html> etiketimizin en üstüne yerleştirin.

```
<?php
//Projeyi açtığınızda, önce giriş sayfasına yönlendirme sağlıyoruz.
session_start(); //We started the session

//Oturum varsa sayfayı yeniden yönlendiriyoruz.
if (!(isset($_SESSION["Session"]) && $_SESSION["Session"] == "9876")) {
    header("location:login.php");
} //Beni hatırla önceden kontrol edilirse, Oturum oluşturur ve sayfayı yönlendiririz.
?>
```

### index.php (Veritabanından Veri Yazdırma)

```
  <table class="table table-striped table-bordered first">
                        <thead>
                            <th>ID</th>
                            <th>Kullanıcı adı</th>
                            <th>Düzenle</th>
                            <th>Sil</th>
                        </thead>
                        <tbody>
                            <?php
                            include('fonc.php');
            $query = $connect->prepare("SELECT * from users"); // Sorgumuzu Yazdık
            $query->execute();
            while ($result = $query->fetch()) {   // Sorgumuzu While ile Döndürüyoruz
                ?>
                <tr>
                    <td><?=$result['id']?></td>
                    <td><?=$result['user']?></td>
                    <td><a href="userupdate.php?id=<?= $result["id"] ?>"><img height="25" width="25" src="img/edit.png"/></a></td>    
                    <td>

                    </a>
                    <a data-toggle="modal" href="#" data-target="#delete<?php echo $result["id"] ?>">
                        <img height="25" width="25" src="img/delete.png"/></a>
                        <!-- Modal -->
                        <div class="modal fade" id="delete<?php echo $result["id"] ?>" tabindex="-1" role="dialog"
                            aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Kullanıcının silinmesi</h4>
                                        </div>
                                        <div class="modal-body">
                                            <h2 style="color: red; text-align: center">Önemli Uyarı!</h2>

                                            <h4 style="text-align: center">
                                                Silmek istediğinden emin misin?<br><b><?php echo $result["user"] ?><br>
                                               </h4>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">
                                                İptal
                                            </button>
                                            <a href="userdelete.php?page=users&amp;id=<?= $result["id"] ?>" class="btn btn-danger">Sil</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>

                        <?php
        } // While End
        ?>
    </tr>
</tbody>
</table>
</div>                   
</tbody>
</table>

```
### index.php (Tüm Kodlar)

```
<?php
//Projeyi açtığınızda, önce giriş sayfasına yönlendirme sağlıyoruz.
session_start(); //We started the session

//Oturum varsa sayfayı yeniden yönlendiriyoruz.
if (!(isset($_SESSION["Session"]) && $_SESSION["Session"] == "9876")) {
    header("location:login.php");
} //Beni hatırla önceden kontrol edilirse, Oturum oluşturur ve sayfayı yönlendiririz.
?>
<!DOCTYPE html>
<html>
<head>
	<title>LOGİN PDO MD5</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/all.min.css">
    <html lang="en">
</head>
<body>
<div class="container">      
        <div class="col-md-6">
            <div class="text-center">
                <h3>LOGİN PDO MD5</h3>
                <a class="btn btn-danger" href="logout.php">Çıkış Yap</a>            
            </div>
            <br/>
        </div>
        <div class="col-md-6">
         <div class="card">
            <a class="btn btn-success" href="useradd.php">Yeni Kullanıcı EKLE</a> 
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered first">
                        <thead>
                            <th>ID</th>
                            <th>Kullanıcı adı</th>
                            <th>Düzenle</th>
                            <th>Sil</th>
                        </thead>
                        <tbody>
                            <?php
                            include('fonc.php');
            $query = $connect->prepare("SELECT * from users"); // Sorgumuzu Yazdık
            $query->execute();
            while ($result = $query->fetch()) {   // Sorgumuzu While ile Döndürüyoruz
                ?>
                <tr>
                    <td><?=$result['id']?></td>
                    <td><?=$result['user']?></td>
                    <td><a href="userupdate.php?id=<?= $result["id"] ?>"><img height="25" width="25" src="img/edit.png"/></a></td>    
                    <td>

                    </a>
                    <a data-toggle="modal" href="#" data-target="#delete<?php echo $result["id"] ?>">
                        <img height="25" width="25" src="img/delete.png"/></a>
                        <!-- Modal -->
                        <div class="modal fade" id="delete<?php echo $result["id"] ?>" tabindex="-1" role="dialog"
                            aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Kullanıcının silinmesi</h4>
                                        </div>
                                        <div class="modal-body">
                                            <h2 style="color: red; text-align: center">Önemli Uyarı!</h2>

                                            <h4 style="text-align: center">
                                                Silmek istediğinden emin misin?<br><b><?php echo $result["user"] ?><br>
                                               </h4>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">
                                                İptal
                                            </button>
                                            <a href="userdelete.php?page=users&amp;id=<?= $result["id"] ?>" class="btn btn-danger">Sil</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>

                        <?php
        } // While End
        ?>
    </tr>
</tbody>
</table>
</div>                   
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

	<script src="js/jquery-3.4.1.min.js"></script>	
	<script src="js/bootstrap.min.js"></script>
</body>
</html>

```

### useradd.php (Tüm Kodlar)(Yeni Kullanıcı Ekleme)

```
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<title>Kullanıcı Ekle</title>
</head>
<body>
<body>
        <div class="container">
            <div class="row">
                <div class="col-md-6">     
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.php">Ana Sayfa</a>
                        </li>
                        <li class="breadcrumb-item active">Yeni Kullanıcı EKLE</li>
                    </ol>            
                    <div class="card mb-3">
                        <div class="card-body">
                            <form method="POST" action="" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Kullanıcı Adı</label>
                                    <input required type="text" class="form-control" name="user" placeholder="Yeni Kullanıcı Adı">
                                </div>
                                <div class="form-group">
                                    <label>Yeni Şifre</label>
                                    <input required type="password" class="form-control" name="password" placeholder="Yeni Şifre">
                                </div>
                                <div class="form-group">
                                    <label>Yeni Şifreyi Onayla</label>
                                    <input required type="password" class="form-control" name="passwordagain" placeholder="Yeni Şifreyi Onayla">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Kaydet</button>
                                    <script type="text/javascript" src="js/sweetalert.min.js"></script>
                                    <?php
                                    include('fonc.php');
                                    
if ($_POST) { // Sayfada bir gönderi olup olmadığını kontrol ediyoruz.

    $user = $_POST['user'];// Sayfa yenilendikten sonra, yayınlanan değerleri değişkenlere atarız
    $password = md5('56' . $_POST['password'] . '23'); 
     // Belirtilen aralıklara göre değişkenleri MD5 Formatı ile şifreliyoruz
    $passwordagain = md5('56' . $_POST['passwordagain'] . '23'); // Değişkenleri MD5 Formatı ile şifreliyoruz   
    $error = "";  // Hatalarımızı yazdırıyoruz

    
    
    if ($user <> "" && $password <> "" && $error == "") { // // Veri alanlarının boş olup olmadığını kontrol ediyoruz. Bunu diğer kontrollerde yapabilirsiniz.
        //Değişecek veriler
        $line = [                       
            'user' => $user,
            'password' => $password, 

        ];

        if ($password == $passwordagain && $password != '' && $user != '') {   // Yeni Şifre ve Tekrarlanan Şifrenin aynı olup olmadığını kontrol etmeu


            $sql = "INSERT INTO users SET user=:user, password=:password;";   
                  // Tüm koşullar olumluysa, veri ekleme sorgumuzu yazarız.
            $status = $connect->prepare($sql)->execute($line);

            if ($status) {
                echo '<script>swal("Yeni Kullanıcı.","Başarılı Yeni Kullanıcı Eklendi.","success").then((value)=>{ window.location.href = "index.php"}); </script>'; 
                //Veri ekleme başarılı olursa, sweetalert ile başarılı olduğu yazılır.

// Add sorgusu çalışırsa, index.php sayfasına yönlendirir.

            }
        }
        else {
            echo '<script>swal("Hata","Hata, Lütfen bilgilerinizi kontrol edin","error");</script>'; 
            // id bulunamazsa veya sorguda bir hata varsa, bir hata yazdırırız
        }
    }
    if ($error != "") {
        echo '<script>swal("Error","' . $error . '","Error");</script>'; // Sorgularda ve veritabanında oluşabilecek hatalarımızı yazdırıyoruz
    }
}
?>                        
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</body>
</html>
```

### userupdate.php (Verileri Veritabanındaki Girişlere Aktarma)(md5 şifreleme formatı ile)

* Veritabanındaki Verilerin giriş daki değer bölümüne aktarıyoruz

```
value="<?= $result["user"] ?>"

```
```
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <title>Kullanıcı Düzenle</title>
</head>
<?php
include('fonc.php');  // Veritabanımızı Bağladık

$query = $connect->prepare("SELECT * FROM users Where id=:id");
    // Gelen kimlikleri değişkenlere ve girdilere aktarıyoruz.
$query->execute(['id' => (int)$_GET["id"]]);
    $result = $query->fetch();//Sorguyu yürütme ve veri alma
?>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.php">Ana Sayfa</a>
                    </li>
                    <li class="breadcrumb-item active">Kullanıcı Güncellemesi</li>
                </ol>
                <div class="card mb-3">

                    <div class="card-body">

                        <form method="post" action="" enctype="multipart/form-data">

                            <div class="form-group">
                                <label>Kullanıcı Adı</label>
                                <input required type="text" value="<?= $result["user"] ?>" class="form-control" name="user"
                                placeholder="Yeni Kullanıcı Adı">
                            </div>

                            <div class="form-group">
                                <label>Yeni Parola</label>
                                <input required type="password" class="form-control" name="password"
                                placeholder="Yeni Parolayı Giriniz">
                            </div>
                            <div class="form-group">
                                <label>Yeni Parolayı Tekrar</label>
                                <input required type="password" class="form-control" name="passwordagain"
                                placeholder="Yeni Parolayı Tekrar Giriniz">
                            </div>


                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Güncelle</button>
                                <script type="text/javascript" src="js/sweetalert.min.js"></script>

                                <?php
                                
if ($_POST) { // Sayfada bir gönderi olup olmadığını kontrol ediyoruz.

    $user = $_POST['user'];// Sayfa yenilendikten sonra, yayınlanan değerleri değişkenlere atarız
    $password = md5('56' . $_POST['password'] . '23');  
    // Belirtilen aralıklara göre değişkenleri MD5 Formatı ile şifreliyoruz
    $passwordagain = md5('56' . $_POST['passwordagain'] . '23'); // MD5 Forma ile değişkenleri şifreliyoruzt   
    $error = "";

    // Veri alanlarının boş olmadığından emin oluruz. Bunu diğer kontrollerde yapabilirsiniz.
    
    if ($user <> "" && $password <> "" && $error == "") { // Veri alanlarının boş olmadığından emin oluruz.
        //Değişecek veriler
        $line = [
            'id' => $_GET['id'],            
            'user' => $user,
            'password' => $password, 


        ];

        if ($password == $passwordagain && $password != '' && $user != '') {
         // Veri alanlarının boş olmadığından emin oluruz. Bunu diğer kontrollerde yapabilirsiniz.

            $sql = "UPDATE users SET user=:user,password=:password WHERE id=:id;";
            $status = $connect->prepare($sql)->execute($line);

            if ($status) {
                echo '<script>swal("Başarılı","Kullanıcı Güncellendi","success").then((value)=>{ window.location.href = "index.php"});

                </script>';
            // Güncelleme sorgusu çalışıyorsa, products.php sayfasına yönlendirilir.
            } 
        }
        else {
            echo '<script>swal("Oops","Hata, Lütfen bilgilerinizi doğru girdiğinizden emin olun.","error");</script>'; // id bulunamazsa veya sorguda bir hata varsa, bir hata yazdırırız.
        }
    }
    if ($error != "") {
        echo '<script>swal("Oops","' . $error . '","error");</script>'; // Sorgularda ve veritabanlarında oluşabilecek hataları yazdırıyoruz.
    }
}

?>
</div>
</form>
</div>
</div>
</div>
</div>
</div>

</body>
</html>

```
#### userupdate.php (Yeni Kullanıcı verilerini veritabanına aktarma)(md5 şifreleme formatı ile)

* Girişlerin "name" kısmına dikkat edin

```
<?php
                                
if ($_POST) { // Sayfada bir gönderi olup olmadığını kontrol ediyoruz.

    $user = $_POST['user'];// Sayfa yenilendikten sonra, yayınlanan değerleri değişkenlere atarız
    $password = md5('56' . $_POST['password'] . '23');  
    // Belirtilen aralıklara göre değişkenleri MD5 Formatı ile şifreliyoruz
    $passwordagain = md5('56' . $_POST['passwordagain'] . '23'); // MD5 Forma ile değişkenleri şifreliyoruzt   
    $error = "";

    // Veri alanlarının boş olmadığından emin oluruz. Bunu diğer kontrollerde yapabilirsiniz.
    
    if ($user <> "" && $password <> "" && $error == "") { // Veri alanlarının boş olmadığından emin oluruz.
        //Değişecek veriler
        $line = [
            'id' => $_GET['id'],            
            'user' => $user,
            'password' => $password, 


        ];

        if ($password == $passwordagain && $password != '' && $user != '') {
         // Veri alanlarının boş olmadığından emin oluruz. Bunu diğer kontrollerde yapabilirsiniz.

            $sql = "UPDATE users SET user=:user,password=:password WHERE id=:id;";
            $status = $connect->prepare($sql)->execute($line);

            if ($status) {
                echo '<script>swal("Başarılı","Kullanıcı Güncellendi","success").then((value)=>{ window.location.href = "index.php"});

                </script>';
            // Güncelleme sorgusu çalışıyorsa, products.php sayfasına yönlendirilir.
            } 
        }
        else {
            echo '<script>swal("Oops","Hata, Lütfen bilgilerinizi doğru girdiğinizden emin olun.","error");</script>'; // id bulunamazsa veya sorguda bir hata varsa, bir hata yazdırırız.
        }
    }
    if ($error != "") {
        echo '<script>swal("Oops","' . $error . '","error");</script>'; // Sorgularda ve veritabanlarında oluşabilecek hataları yazdırıyoruz.
    }
}

?>

```

#### userdelete.php (Kullanıcıları siliyor)

```
<?php
session_start(); //Bir oturum başlattık

//Geçerli oturum varsa sayfayı yönlendirir
if (!(isset($_SESSION["Session"]) && $_SESSION["Session"] == "9876")) {
    header("location:login.php");
} //Beni hatırla önceden kontrol edilirse, bir oturum oluşturur ve sayfayı yönlendiririz.

if ($_GET) {

    $page = $_GET["page"];
    include("fonc.php"); // Veritabanı bağlantımızı sayfamıza dahil ediyoruz.
    $query = $connect->prepare("SELECT * FROM $page Where id=:id");
    $query->execute(['id' => (int)$_GET["id"]]);
    $result = $query->fetch();//Sorguyu yürütme ve veri alma

    // Kimliği seçilen verileri silmek için sorgumuzu yazıyoruz.
    $where = ['id' => (int)$_GET['id']];
    $status = $connect->prepare("DELETE FROM $page WHERE id=:id")->execute($where);
    if ($status) {
        header("location:index.php"); // Sorgu işe yararsa, index.php sayfasına göndeririz.
    }
}
?>
```

### logout.php (Çıkış Yap) 
```
<?php
session_start();
session_destroy();
setcookie("Session", md5("aa" . $txtuser . "bb"), time() - 1);

header("location:index.php");

?>
```

İyi Kodlamalar 😉
