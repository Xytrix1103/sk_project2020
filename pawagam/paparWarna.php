<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <script>
        if (localStorage.getItem("warna") === null){
            localStorage.setItem("warna", "orange");
        }

        if (localStorage.getItem("warna") == "orange") {
            var rgbTukaran = "rgb(0, 191, 255)";
            var hex = "#FFA500";
        } else if (localStorage.getItem("warna") == "dark sky blue") {
            var rgbTukaran = "rgb(255, 165, 0)";
            var hex = "#00BFFF";
        }

        $(document).ready(function(){
            $("*").each(function(){
                var color = $(this).css("color");
                if (color == rgbTukaran) {
                    $(this).css("color", hex);
                }
                var bg_color = $(this).css("background-color");
                if (bg_color == rgbTukaran) {
                    $(this).css("background-color", hex);
                }
                var br_color = $(this).css("border-color");
                if (br_color == rgbTukaran) {
                    $(this).css("border-color", hex);
                }
            });
        });
    </script>
</html>