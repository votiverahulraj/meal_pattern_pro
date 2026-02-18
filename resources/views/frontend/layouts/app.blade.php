<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meal Pattern Pro</title>
    <!-- favicon-icon  -->
    <link rel="shortcut icon" href="{{ url('/') }}/assets/images/favicon.png" />

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap icon CDN  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- custom css -->
    <link rel="stylesheet" href="{{ url('/') }}/user/assets/css/style.css">
    <link rel="stylesheet" href="{{ url('/') }}/user/assets/css/header.css">
    <link rel="stylesheet" href="{{ url('/') }}/user/assets/css/footer.css">
    <link rel="stylesheet" href="{{ url('/') }}/user/assets/css/home.css">
</head>

<body>

    <!-- ================= NAVBAR ================= -->
@include('frontend.layouts.header')

@yield('content')

    <!-- FOOTER -->

@include('frontend.layouts.footer')
    <!-- js  -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"></script> -->
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        window.addEventListener("scroll", function () {
            const header = document.querySelector("header");

            if (window.scrollY > 50) {
                header.classList.add("sticky");
            } else {
                header.classList.remove("sticky");
            }
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            function counter(id, start, end, duration) {
                let obj = document.getElementById(id),
                    current = start,
                    range = end - start,
                    increment = end > start ? 1 : -1,
                    step = Math.abs(Math.floor(duration / range)),
                    timer = setInterval(() => {
                        current += increment;
                        obj.textContent = current;
                        if (current == end) {
                            clearInterval(timer);
                        }
                    }, step);
            }
            counter("count1", 0, 22, 2500);
            counter("count2", 0, 99, 2500);
            counter("count3", 0, 100, 2500);
            counter("count4", 0, 400, 2500);
        });

    </script>


</body>

</html>