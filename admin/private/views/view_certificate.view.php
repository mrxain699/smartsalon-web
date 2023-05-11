<?php $image_url =   DEFAULT_URL."/uploads/".$image; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            min-height:100vh;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #000;
        }
        #box{
            width: 70%;
            height: 70%;
            overflow: hidden;
            border-radius: 15px;
        }
        #img{
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }
    </style>
</head>
<body>
    <div id="box">
        <img src="<?= $image_url ?>" id="img">
    </div>
</body>
</html>