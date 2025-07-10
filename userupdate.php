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
