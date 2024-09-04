<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')
    <title>Samsung IMEI Sorgulama</title>
    <meta name="description" content="Samsung IMEI Sorgulama: Kayıp veya çalıntı Samsung cihazınızın imei numarasını ücretsiz sorgulayın. Güvenli ve hızlı sonuçlar için deneyin.">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>

    <!-- Styles -->
</head>
@component('components.header')@endcomponent
@component('components.sayfalar.samsung-body')@endcomponent
@component('components.anasayfa.body')@endcomponent
@component('components.footer')@endcomponent
</html>
