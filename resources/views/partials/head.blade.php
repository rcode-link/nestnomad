<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />

<title>{{ $title ?? config("app.name") }}</title>

<link rel="icon" href="/favicon.ico" sizes="any" />
<link rel="icon" href="/favicon.svg" type="image/svg+xml" />
<link rel="apple-touch-icon" href="/apple-touch-icon.png" />
<script src="/js/wow.min.js" defer></script>
<meta name="description" content="@lang('public.description')">
<meta name="keywords" content="@lang("public.keywords")">

<script defer src="https://cloud.umami.is/script.js" data-website-id="800b6c5e-9eb9-4284-8cc5-aee6b2723517"></script>
@vite(["resources/css/app.css", "resources/js/app.js"])
@fluxAppearance
