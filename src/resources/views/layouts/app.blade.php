<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','記録')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;500;700&display=swap" rel="stylesheet">
<style>
        body {
            font-family: 'Noto Sans JP', sans-serif;
            -webkit-font-smoothing: antialiased;
            background-color: #bbe1f5fe;
            color: #426a6a;
        }
    </style>
</head>

<body class="min-h-screen px-4 selection:bg-gray-200">
  <div class="mb-8 max-w-md mx-auto">
    <p class="text-xs font-bold">Baby Record</p>
    <h1 class="text-2xl font-light">赤ちゃん成長記録</h1>
  </div>
  @yield('content')
</body>

@yield('script')

</html>
