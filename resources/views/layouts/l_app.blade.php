@include('website.library')
@include('landing.header')
<body>
<script>
        (function(w,d,u){
               var s=d.createElement('script');s.async=true;s.src=u+'?'+(Date.now()/60000|0);
               var h=d.getElementsByTagName('script')[0];h.parentNode.insertBefore(s,h);
       })(window,document,'https://cdn.bitrix24.com/b10971313/crm/site_button/loader_7_xt05hu.js');
</script>
<!-- Google Tag Manager (noscript) -->
<noscript><ifr ame src="https://www.googletagmanager.com/ns.html?id=GTM-KLVSVGN"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
@yield('content')
@include('landing.footer')
</body>
</html>
