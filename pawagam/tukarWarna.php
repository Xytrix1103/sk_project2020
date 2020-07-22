<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <button id="tukar"> Tukar Mod Warna </button>
    <script>
        $("#tukar").click(function () {
            if (localStorage.getItem("warna") == "orange") {
                localStorage.setItem("warna", "dark sky blue");
                var rgbTukaran = "rgb(0, 191, 255)";
                var rgb = "rgb(255, 165, 0)";
            } else if (localStorage.getItem("warna") == "dark sky blue") {
                localStorage.setItem("warna", "orange");
                var rgbTukaran = "rgb(255, 165, 0)";
                var rgb = "rgb(0, 191, 255)";
            } 
            $("*").each(function () {
                var color = $(this).css("color");
                if (color == rgb) {
                    $(this).css("color", rgbTukaran);
                }
                var bg_color = $(this).css("background-color");
                if (bg_color == rgb) {
                    $(this).css("background-color", rgbTukaran);
                }
                var br_color = $(this).css("border-color");
                if (br_color == rgb) {
                    $(this).css("border-color", rgbTukaran);
                }
            });
        });
    </script>
</html>