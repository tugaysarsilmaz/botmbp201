<!DOCTYPE html>
<html lang="tr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        
        <link rel="stylesheet" href="https://getbootstrap.com/docs/4.1/dist/css/bootstrap.min.css">


        <link rel="stylesheet" href="http://getbootstrap.com/docs/4.1/examples/sticky-footer-navbar/sticky-footer-navbar.css">
        <link rel="stylesheet" href="style.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <title>Ödev</title>
    </head>

    <body>

        <! -- navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <a class="navbar-brand" href="#">Sohbet Robotu</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

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
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Ara" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Ara</button>
                </form>
            </div>
        </nav>

        <?php 
      $handle = curl_init();
 
      $url = "https://api.stackexchange.com/2.2/search?order=desc&sort=votes&tagged=php&site=stackoverflow";
       

      function get_web_page( $url )
      {
          $options = array(
              CURLOPT_RETURNTRANSFER => true,     // return web page
              CURLOPT_HEADER         => false,    // don't return headers
              CURLOPT_FOLLOWLOCATION => true,     // follow redirects
              CURLOPT_ENCODING       => "",       // handle all encodings
              CURLOPT_USERAGENT      => "spider", // who am i
              CURLOPT_AUTOREFERER    => true,     // set referer on redirect
              CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
              CURLOPT_TIMEOUT        => 120,      // timeout on response
              CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
              CURLOPT_SSL_VERIFYPEER => false     // Disabled SSL Cert checks
          );
      
          $ch      = curl_init( $url );
          curl_setopt_array( $ch, $options );
          $content = curl_exec( $ch );
          $err     = curl_errno( $ch );
          $errmsg  = curl_error( $ch );
          $header  = curl_getinfo( $ch );
          curl_close( $ch );
      

          return $content;
      }
      $x = get_web_page($url);
      $json = json_decode($x, true)['items'];
      $i = 1;
      ?>
      <h1>Soru Cevapların Listesi</h1>
      <table class="table">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Dil</th>
          <th scope="col">Soru</th>
          <th scope="col">Cevap</th>
        </tr>
      </thead>
      <tbody>
          <?php 
            foreach($json as $key => $val){
              echo '
                <tr>
                  <th scope="row">'.$i.'</th>
                  <td>PHP</td>
                  <td>'.$val['title'].'</td>
                  <td>--</td>
                </tr>
              ';
              $i++;
            }
          ?>
            </tbody>
        </table>
        
    <footer class="footer ">
      <div class="container">
        <span class="text-muted ">Place sticky footer content here.</span>
      </div>
    </footer> 
    
    </body>

</html>
