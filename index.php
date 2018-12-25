<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <title>Document</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <a class="navbar-brand" href="#">Sohbet Robotu</a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Ana Sayfa <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Diller</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Sohbet Kutusu</a>
                </li>
            </ul>
        </div>
    </nav>

    <form action="./" method="POST">
        <div class="form-group" style="margin-top: 30px;">
            <div class="input-group mb-3">
                <label class="col-sm-1 col-form-label">Soru: </label>
                <input class="col-md-4" name="soru" type="text" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1">
            </div>
            <div class="input-group mb-3">
                <label class="col-sm-1 col-form-label">Dili: </label>
                <input class="col-md-2" name="dili" type="text" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1">
            </div>

            <div class="input-group mb-3">
                <button type="submit" class="btn btn-warning">Onayla</button>
            </div>
        </div>
    </form>

    <?php 
        $cevap = false;
        if ($_POST) {
            $soru = $_POST["soru"];
            $dili = $_POST["dili"];

            $json = '[
                {"no": "1", "dili": "PHP", "soru": "Değişken nasıl tanımlanır?", "cevap":"Değişkenin başına $ işareti konularak tanımlanır."},
                {"no": "2", "dili": "PHP", "soru": "Dizgelerin birleştirilmesi nasıl gerçekleştirilir?", "cevap": "Dizgeler \'.\' işleci ile birleştirilir."},
                {"no": "3", "dili": "C", "soru": "Ekrandan kullanıcı girdisi hangi ifade ile alınır?", "cevap": "Kullanıcı girdisi \'scanf\' ifadesi ile alınır."},
                {"no": "4", "dili": "C", "soru": "Fonksiyonda \'return\' ne anlama gelmektedir?", "cevap": "Fonksiyonun dönüş değeri içerdiği anlamına gelmektedir."},
                {"no": "5", "dili": "", "soru": "merhaba", "cevap": "Selam"},
                {"no": "6", "dili": "", "soru": "nasılsın ?", "cevap": "iyiyim, siz de iyisinizdir. Sorunuz neydi ?"}
            ]';
    
            $veriler = json_decode($json, true);

            foreach ($veriler as $veri) {
                if ($veri["dili"] == $dili && $veri["soru"] == $soru) {
                    $cevap = $veri["cevap"];
                    $message[]=[
                        "soru"=>$soru,
                        "dili"=>$dili,
                        "cevap"=>$veri["cevap"]
                    ];

                    if(!$_COOKIE["check"]){
                        setcookie("check",json_encode($message),time()+3600);

                    }else{
                        $oncekiMesajlar=json_decode($_COOKIE["check"]);
                        $tumMesajlar=array_merge($oncekiMesajlar,$message);
                        setcookie("check",json_encode($tumMesajlar),time()+3600);
                    }

                }
            }

             header("location:index.php");
        }
    ?>

    <?php 
    if(@$_COOKIE["check"]){
     $Mesajlar=json_decode($_COOKIE["check"]);
    
    foreach($Mesajlar as  $mesaj){
        ?>
      <div class="alert alert-info" role="alert">
            kullanıcı: <?php echo $mesaj->soru; ?> <br>
            bot: <?php echo $mesaj->cevap;  ?>
        </div>
        <?php
    } ?>

  

   <?php } ?>

    <div class="alert alert-success fixed-bottom" role="alert" style="margin-bottom: 0px;">
        Sohbet Robotu ver 1.0
    </div>

</body>

</html>