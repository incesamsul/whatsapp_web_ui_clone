<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/scan.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- scanner -->
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <title>Scan Page</title>
</head>

<body>
    <div id="content-wrapper">
        <nav class="navbar navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="#">
                    <i class="fas fa-arrow-left"></i><span class="ms-4"> Pindai kode QR</span>
                </a>
            </div>
        </nav>
        <section id="scan-instruction">
            Untuk menggunakan Whatsapp web buka web.whatsapp.com pada komputer Anda
        </section>
        <section id="camera-wrapper">
            <video id="preview" class="p-1 border" style="width:100%;"></video>
            <div class="scan-area"></div>
            <div class="top left"></div>
            <div class="top right"></div>
            <div class="bottom right"></div>
            <div class="bottom left"></div>
        </section>
    </div>
    <script>
        var scanner = new Instascan.Scanner({
            video: document.getElementById('preview'),
            scanPeriod: 5,
            mirror: false
        });

        scanner.addListener('scan', function(content) {
            console.log(content);
            alert(content);

        });
        Instascan.Camera.getCameras().then(function(cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[1]);
                $('[name="options"]').on('change', function() {
                    if ($(this).val() == 1) {
                        if (cameras[0] != "") {
                            scanner.start(cameras[0]);
                        } else {
                            alert('No Front camera found!');
                        }
                    } else if ($(this).val() == 2) {
                        if (cameras[1] != "") {
                            scanner.start(cameras[1]);
                        } else {
                            alert('No Back camera found!');
                        }
                    }
                });
            } else {
                console.error('No cameras found.');
                alert('No cameras found.');
            }
        }).catch(function(e) {
            console.error(e);
            alert(e);
        });
    </script>
</body>

</html>