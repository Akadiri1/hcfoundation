<?php

switch ($page_title) {
  case 'Home':
  include 'seo/home_meta.php';
    break;
  case 'About Us':
  include 'seo/about_meta.php';
    break;

  case 'Blog Details':
  include 'seo/blog_meta.php';
    break;

  case 'Projects Details':
  include 'seo/blog_meta.php';
  break;

  case 'Service Details':
  include 'seo/blog_meta.php';
  break;


  default:
  include 'seo/home_meta.php';
  break;
}































 ?>
