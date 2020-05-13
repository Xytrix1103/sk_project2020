<html>

    <head>
    
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <style>

            html {
                width: 100%;
                height: 100%;
                overflow-x: hidden;
            }

            #header {
                position: sticky;
                top: 0;
                z-index: 99;
                font-family: "Courier New";
                height: 88px;
            }

            #logo {
                margin-left: auto;
                margin-right: auto;
                height: 36px;
                width: auto;
                z-index: 99;
                display: block;
                margin-top: 26px;
            }

            body {
                font-family: "Courier New", "Courier", "serif";
                background-color: orange;   
                width: 100%;
                height: 100%;
                overflow-x: hidden;     
            }

            input[type=text], input[type=password] {
                width: 100%;
                padding: 12px 20px;
                margin: 8px 0;
                display: inline-block;
                border: 1px solid #ccc;
                box-sizing: border-box;
            }

            button {
                background-color: black;
                color: orange;
                padding: 14px 20px;
                margin: 8px 0;
                border: none;
                cursor: pointer;
                width: 100%;
            }

            b {
                font-size: 24px;
            }

        </style>

    </head>

    <body>
    
        <div class="row" id="header">

            <div class="col-md-12" id="nama" style="background-color:black;">

                <a><img id="logo" src="./img/cinemaHSY.png">

            </div>

        </div>

        <center>

            <h2 style="font-size:40px;font-weight:bold;padding:30px;">Selamat Datang!</h2>

        </center>
        
        <form action="auth.php" method="POST">

            <div class="container">

                <label for="usernamePengguna" style="margin-bottom:20px;"><b>Username Pengguna</b></label>
                <input style="margin-bottom:50px;" type="text" placeholder="Sila masukkan username anda" name="username" required>

                <label for="passwordPengguna" style="margin-bottom:20px;"><b>Password Pengguna</b></label>
                <input style="margin-bottom:50px;" type="password" placeholder="Sila masukkan password anda" name="kataLaluan" required>
                    
                <button type="submit" style="font-size:20px;">Daftar Masuk</button>

            </div>
            
        </form>

    </body>

</html>