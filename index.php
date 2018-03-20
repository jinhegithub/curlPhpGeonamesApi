<?php
function curl_post($url, $data, $header = array()) {
    $ch = curl_init($url);
    if( !empty($header) ) {
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    }
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}

if( isset($_GET['search']) && $_GET['search'] == true ) {
    $geoSearchRes = curl_post( 'http://api.geonames.org/postalCodeSearchJSON?' . http_build_query($_POST), $_POST );
    echo $geoSearchRes;return;
}
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fetch City State Name Using GeoName API, cURL and PHP</title>
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="js/custom.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Fetch City State Name Using GeoName API, cURL and PHP</h1>
                <form role="form" method="post" action="#" id="formValidation">
                    <div class="form-group">
                        <label for="Country">Country</label>
                        <select id="Country" name="Country" class="form-control">
                            <option value="bd">Bangladesh</option>
                            <option value="us">USA</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="postZipCode">Zip</label>
                        <input id="postZipCode" name="postZipCode" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="city">City</label>
                        <input id="city" name="city" type="text" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="provinceState">State</label>
                        <input id="provinceState" name="provinceState" type="text" class="form-control" readonly>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>