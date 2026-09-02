<?php
  $uro = 'https://'.$_SERVER['HTTP_HOST']."/";
 $bd = previewBody($projects[0]['input_title'], 22);
 $rf = strip_tags($bd);

 $cut = explode(' ',$projects[0]['input_title']);
 $projectsMeta = implode(',',$cut).",";
 echo '<meta name="description" content="'.$rf.'" />
 <meta name="keywords" content="'.$projectsMeta.'projects">';
 echo '<meta property="og:title" content="'.$site_name." - ".ucwords($projects[0]['input_title'] ).'" />
 <meta property="og:type" content="article" />
 <meta property="og:image" content="'.$projects[0]['image_1'].'" />
 <meta property="og:image:width" content="450"/>
 <meta property="og:image:height" content="298"/>
 <meta property="og:description" content="'.$rf.'" />';
 echo '<meta name="twitter:card" content="summary_large_image">
 <meta name="twitter:title" content="'.$site_name." - ".ucwords($projects[0]['input_title'] ).'">
 <meta name="twitter:description" content="'.$rf.'">
 <meta name="twitter:image" content="'.$projects[0]['image_1'].'">
 <meta name="twitter:image:width" content="280">
 <meta name="twitter:image:height" content="150">';
  ?>
