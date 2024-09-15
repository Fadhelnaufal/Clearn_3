<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('quiz/css/style.css') }}" />
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="start-screen">
                <h1 class="heading">Quiz App</h1>
                <div class="group">
                    <input class="input" type="search" placeholder="Masukkan Token Kelas" />
                </div>
                <button class="btn start">Start Quiz</button>
            </div>

        </div>
        <script src="{{ asset('quiz/js/script.js') }}"></script>
</body>

</html>
