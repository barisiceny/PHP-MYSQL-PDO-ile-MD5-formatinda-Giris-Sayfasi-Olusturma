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
