	<?php


	$metaImage = (stringStartWith($metaImage, "http")) ? $metaImage : "https://".$_SERVER['HTTP_HOST'].$metaImage;


		if (!isset($ogMetaImage)) {
			$ogMetaImage = $metaImage;
		}

		if (!isset($twitterMetaImage)) {
			$twitterMetaImage = $metaImage;
		}

		$metaDescription = previewBodyWithElipsces($metaDescription, 50, true);
	 ?>
	<meta property="og:locale" content="en_GB" />


    <!-- SEO -->
    <meta name="title" content="<?=$metaTitle?>">
    <meta name="description" content="<?=$metaDescription?>">
    <meta name="keywords" content="<?=implode(", ", $siteKeywords)?>">
    <meta name="author" content="<?=$site_name?>">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?=$current_uri?>">
    <meta property="og:title" content="<?=$metaTitle?>">
    <meta property="og:type" content="article">
    <meta property="og:description" content="<?=$metaDescription?>">
    <meta property="og:image" content="<?=$ogMetaImage?>">
    <meta property="og:image:width" content="200">
    <meta property="og:image:height" content="200">

    <!-- Twitter -->
    <meta name="twitter:site" content="@mckodev">
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?=$current_uri?>">
    <meta property="twitter:title" content="<?=$metaTitle?>">
    <meta property="twitter:description" content="<?=$metaDescription?>">
    <meta property="twitter:image" content="<?=$twitterMetaImage?>">
    <meta name="twitter:image:width" content="280">
    <meta name="twitter:image:height" content="150">



    <!-- Meta Tags -->
    <meta name="theme-color" content="<?=$style_colorPrimary?>">
    <meta name="application-name" content="<?=$site_name?>">




    <!-- Apple -->
    <meta name="apple-mobile-web-app-title" content="<?=$metaTitle?>">
    <link rel="mask-icon" href="/favicons/safari-pinned-tab.svg" color="<?=$style_colorPrimary?>">

	<link rel="apple-touch-icon" sizes="57x57" href="/logo1.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/logo1.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/logo1.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/logo1.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/logo1.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/logo1.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/logo1.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/logo1.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/logo1.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/logo1.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/logo1.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/logo1.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/logo1.png">
    <link rel="manifest" href="/favicon/manifest.json">
    <meta name="msapplication-TileImage" content="/logo1.png">
    <meta name="theme-color" content="<?=$style_colorPrimary?>">

    <!-- Microsoft -->
    <meta name="msapplication-TileColor" content="<?=$style_colorPrimary?>">
