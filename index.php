<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>

    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <title>Wassap!</title>
</head>

<body>
    <nav class="navbar navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="./assets/img/icon.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
                WHATSAPP WEB
            </a>
        </div>
    </nav>
    <section id="content-wrapper">
        <div class="hero"></div>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card border-0 landing-card">
                        <div class="row instruction-wrapper">
                            <div class="col-sm-7">
                                <p class="head-login-text">To Use WhatsApp On Your Computer : </p>
                                <ol class="mt-5 mb-5">
                                    <li>Open Whatsapp on your phone</li>
                                    <li>Tap <Strong>Menu </Strong><i class="fas fa-ellipsis-v"></i> or <strong>Setting </strong> <i class="fas fa-cog"></i> and select <strong>Linked Devices </strong></li>
                                    <li>Point your phone to this screen to capture the code</li>
                                </ol>
                                <a href="" class="mt-5 help-link">Need help to get started ? </a>
                            </div>
                            <div class="col-sm-5 d-flex justify-content-end align-items-end flex-column">
                                <div class="qrcode-wrapper d-flex align-items-center flex-column">
                                    <div id="qrcode"></div>
                                    <div class="mt-4form-group mt-3 d-flex align-items-center justify-content-center">
                                        <input checked type="checkbox" name="tetap_masuk" id="tetapmasuk"> <small class="mx-2 txt-tetap-masuk">Tetap Masuk</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script>
        let randval = "";
        let current_ref = null;
        let qrcode = new QRCode("qrcode", {
            colorDark: "#295353",
            colorLight: "#ffffff",
        });
        let tout;

        function loginCheck() {
            $.ajax({
                url: '/Qrcodelogin/public/ajax/qrcodeCheck',
                dataType: 'json',
                success: function(data) {

                    if (!data) {
                        console.log('tdk ada yg logn');
                    } else {
                        if (data.token == randval) {
                            $.ajax({
                                url: '/Qrcodelogin/public/ajax/ajaxPostLogin',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                method: 'post',
                                data: {
                                    username: data.username,
                                    password: data.password
                                },
                                success: function(data) {
                                    if (data == 1) {
                                        // alert('what');
                                        location.reload();
                                    }
                                }
                            })
                            document.body.innerHTML = "loading";
                            clearTimeout(tout);
                        }
                    }
                }
            });
            tout = setTimeout(loginCheck, 1000 * 1);
        }

        function makeid(length) {
            var result = '';
            var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            var charactersLength = characters.length;
            for (var i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() *
                    charactersLength));
            }
            return result;
        }

        function refreshQRCode() {
            // randval = Math.random().toString(12).slice(2);
            let randval = makeid(50);
            console.log(randval);
            qrcode.makeCode(randval);
            tout = setTimeout(refreshQRCode, 1000 * 10);
        }
        $(document).ready(function() {
            $(".profile").hide();
            loginCheck();
            refreshQRCode();
        });
    </script>
</body>

</html>