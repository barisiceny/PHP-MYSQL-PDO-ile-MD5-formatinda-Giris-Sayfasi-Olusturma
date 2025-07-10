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
