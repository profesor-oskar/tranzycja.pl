<!DOCTYPE html>
<html lang="pl" style="background-color: #A0AEC0">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="description" content="{{ $page->description ?? $page->opisWitryny }}">
        <meta name="format-detection" content="telephone=no">

        <meta property="og:site_name" content="{{ $page->nazwaWitryny }}">
        <meta property="og:title" content="{{ $page->title() ?  $page->title() . ' | ' : '' }}{{ $page->nazwaWitryny }}">
        <meta property="og:description" content="{{ $page->description ?? $page->opisWitryny }}">
        <meta property="og:url" content="{{ $page->baseUrl }}{{ $page->getPath() == '/home' ? '' : $page->getPath() }}">
        <meta property="og:image" content="{{ $page->baseUrl }}/assets/img/social-share.png">
        <meta property="og:type" content="website">

        <meta name="twitter:image:alt" content="{{ $page->nazwaWitryny }}">
        <meta name="twitter:description" content="{{ $page->description ?? $page->opisWitryny }}">
        <meta name="twitter:image" content="{{ $page->baseUrl }}/assets/img/social-share.png">
        <meta name="twitter:card" content="summary_large_image">

        <title>{{ $page->nazwaWitryny }}{{ ($force_title ?? false) ? (' | ' . $force_title) : ($page->title() ? ' | ' . $page->title() : ' – ' . $page->opisWitryny) }}</title>

        <link rel="home" href="{{ $page->baseUrl ?: '/' }}">
        <link rel="icon" href="/favicon.ico?v=2">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        @stack('meta')

        <link id="stylesheet_link" rel="stylesheet" href="{{ mix('css/main.css', 'assets/build') }}" data-mainsheeturl="{{ mix('css/main.css', 'assets/build') }}" data-manualmodesheeturl="{{ mix('css/manual_mode.css', 'assets/build') }}">

        <script>
            if (localStorage.theme == 'dark' || localStorage.theme == 'light') {
                el = document.getElementById('stylesheet_link')
                el.href = el.dataset.manualmodesheeturl
            }
            requestAnimationFrame(() => {
                if (localStorage.theme == 'dark') {
                    document.documentElement.classList.add('dark'); 
                    document.body.classList.add('dark');
                }
            })
     
        </script>

        <!-- Matomo -->
        <script>
            var _paq = window._paq = window._paq || [];
            /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
            _paq.push(['trackPageView']);
            _paq.push(['enableLinkTracking']);
            (function() {
                var u="https://matomo.kohezja.org/";
                _paq.push(['setTrackerUrl', u+'matomo.php']);
                _paq.push(['setSiteId', '4']);
                var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
                g.async=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
            })();
        </script>
        <!-- End Matomo Code -->
    </head>

    <body style="visibility:hidden" tabindex="0" class="flex flex-col justify-between min-h-screen bg-gray-200 dark:bg-gray-900 text-gray-800 dark:text-gray-400 leading-normal font-sans">
        <header class="bg-gray-100 dark:bg-gray-800 z-10" role="banner">
            @include('__source.partials.menu', $page->mainNav)
        </header>

        <div class="w-full flex-auto {{ $container_class ?? '' }} pt-8">
            @yield('body')
        </div>
        
        <script src="{{ mix('js/main.js', 'assets/build') }}"></script>
        <script src="{{ mix('js/search/index.js', 'assets/build') }}"></script>
        @stack('scripts')
        <footer class="bg-gray-100 dark:bg-gray-900 text-center text-sm mt-12 p-4 relative" role="contentinfo">
            <div class="xl:absolute block top-8 left-8 footer-socials">
            <a href="https://www.facebook.com/tranzycjapl" class="border-b-0 mr-5" target="blank">
                <img src="/assets/img/facebook-logo.png" alt="Facebook" class="h-12 inline">
            </a>
            <a href="https://www.instagram.com/tranzycja.pl/" class="border-b-0" target="blank">
                <img src="/assets/img/instagram-logo.png" alt="Instagram" class="h-12 inline">
            </a>    
        </div>
            @include('_ogolne.stopka')
        </footer>
        <!--TAGS: {{$page->tags}}-->
        <!--LANG: {{$page->lang}}-->
    </body>
</html>
