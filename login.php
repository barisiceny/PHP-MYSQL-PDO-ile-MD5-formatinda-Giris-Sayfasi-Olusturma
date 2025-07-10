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
