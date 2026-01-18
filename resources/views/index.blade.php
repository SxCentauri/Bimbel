<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Latihan Mandiri</title>

    @include('incindex.style')
</head>
<body>

<!-- TOP BAR -->
@include('incindex.topbar')


<!-- KERTAS A4 -->
<div class="page">

    @yield('content')
    
</div>

<!-- Ionicons -->
@include('incindex.scricpt')

</body>

</html>
