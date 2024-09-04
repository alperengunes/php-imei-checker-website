<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    // Attach a submit handler to the form
    $(document).ready(function(){
        var form = '#imeiCheck';

        $(form).on('submit', function(event){
            event.preventDefault();
            var url = "/api/public/imei/check"
            $.ajax({
                url: url,
                method: 'POST',
                data: JSON.stringify({ "imei": $('#imei').val() }),
                dataType: 'JSON',
                contentType: "application/json",
                accept: 'application/json',
                cache: false,
                processData: true,
                success:function(response)
                {
                    var dataMap = JSON.parse(JSON.stringify(response));
                    if(dataMap.check.isValid) {
                        $('#result').html(
                            '<div class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-8 md:p-12 mb-8">' +
                            '<span class="flex flex-col space-y-4 text-gray-900 dark:text-white text-3xl md:text-5xl font-extrabold mb-2 bottom-5">Sonuç Bulundu</span><br>' +
                            '<span class="md:text-2xl font-extrabold dark:text-gray-200">IMEI Numarası: ' + dataMap.imei + '</span><br>' +
                            '<span class="md:text-2xl font-extrabold dark:text-gray-200">Marka: ' + dataMap.check.TelephoneBrand + '</span><br>' +
                            '<span class="md:text-2xl font-extrabold dark:text-gray-200">Model: ' + dataMap.check.TelephoneModel + '</span><br>' +
                            '<span class="md:text-2xl font-extrabold dark:text-gray-200">Kaynak: ' + dataMap.check.ImeiSource + '</span><br>' +
                            '</div>'
                        );
                    }else{
                        $('#result').html(
                            '<div class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-8 md:p-12 mb-8">' +
                            '<span class="flex flex-col space-y-4 text-gray-900 dark:text-white text-3xl md:text-5xl font-extrabold mb-2 bottom-5">Sonuç Bulunamadı</span><br>'+
                            '</div>'
                        );
                    }
                },
                error: function(response) {
                    console.log(response)
                }
            });
        });

    });
</script>
<div>
<section class="bg-white dark:bg-gray-900">
    <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16 z-10 relative top-20">
        <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">Güvenilir Imei Sorgulama Servisi</h1>
        <p class="mb-8 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 lg:px-48 dark:text-gray-200">Merak ettiğiniz ikinci el cep telefonunu veya yeni satın aldığınız cihazı güvenle kullanmak için doğru yerdesiniz! İMEI numarasıyla cihazınızın geçmişini detaylı bir şekilde öğrenin. Müşteri memnuniyetini ön planda tutan güvenilir IMEI sorgulama servisimiz sayesinde, telefonunuzun kayıp, çalıntı ya da yasal olmayan bir cihaz olup olmadığını anında öğrenin.</p>
        <form class="w-full max-w-md mx-auto" id="imeiCheck">
            <div class="relative">
                <input type="number" id="imei" class="block w-full p-4 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Buraya imei numaranızı girin" required>
                <button type="submit" id="sorgula" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Sorgula</button>
            </div>
            <div class="p-10">
                <span class="dark:text-white">
                    IMEI numaranızı, cihazınızın numara çevirme ekranına <span class="font-bold hover:border-slate-400">*#06#</span> yazarak öğrenebilirsiniz.
                </span>
            </div>
        </form>
        <div id="result"></div>
    </div>
    <div class="bg-gradient-to-b from-blue-50 to-transparent dark:from-blue-900 w-full h-full absolute top-0 left-0 z-0"></div>
</section>
</div>
