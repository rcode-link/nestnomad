<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />

<title>{{ $title ?? config("app.name") }}</title>

<link rel="icon" href="/favicon.ico" sizes="any" />
<link rel="icon" href="/favicon.svg" type="image/svg+xml" />
<link rel="apple-touch-icon" href="/apple-touch-icon.png" />
<script src="/js/wow.min.js" defer></script>

@vite(["resources/css/app.css", "resources/js/app.js"])
@fluxAppearance
