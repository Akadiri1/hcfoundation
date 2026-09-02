<?php
$jsonData = file_get_contents('php://input');

$data = json_decode($jsonData);
// var_dump($data);
if (isset($data)) {

  $start = $data->start;
  $limit = $data->limit;
  $offset = $limit * $start;
  $page = $data->page;

  // die(var_dump($start));

if ($page == "blog") {
  $blog = selectContentDescPagination($conn, 'panel_blog', ['visibility' => 'show'], 'id', $offset, $limit);
  // var_dump($blog);
  $result[] =  $blog;


?>
     <?php foreach($blog as $value):?>
       <!--Blog One Single Start-->
       <div class="col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="100ms">
           <div class="blog-one__single">
               <div class="blog-one__img">
                   <img src="<?=$value['image_1']?>" alt="">
                   <div class="blog-one__date">
                       <span><?=date("d",strtotime($value['date_created']))?></span>
                       <p><?=date("M",strtotime($value['date_created']))?></p>
                   </div>
               </div>
               <div class="blog-one__content">
                   <ul class="blog-one__meta list-unstyled">
                       <li>
                           <a href="/blog-details"><i class="fas fa-user-circle"></i><?=$value['input_author_name'] ?? "Admin"?></a>
                       </li>
                     </ul>
                   <h3 class="blog-one__title"><a href="/blog-details"><?=$value['input_title']?></a></h3>
               </div>
           </div>
       </div>
       <!--Blog One Single End-->
    <?php endforeach; ?>
  <?php
  return $result;
}elseif ($page == "blog?cat=") {
$getId = $data->getId;
  $blog = selectContentDescPagination($conn, 'panel_blog', ['visibility' => 'show', 'select_blog_category' => $getId], 'id', $offset, $limit);

  // var_dump($selectBlog);
  $result[] =  $blog;

  $category = selectContent($conn,"selection_blog_category",["visibility" => "show"]);
      $category_data = [];
      foreach ($category as $key => $value) {
        $category_data[$value['id']] = $value['input_category_title'];
    }

 ?>

 <?php foreach($blog as $value):?>
   <!-- Single Blog Start -->
   <div class="single-blog single-blog-post" style="background-color:<?=$section1[0]['bgcolor_content']?>">
       <div class="blog-img">
           <a href="read-blog?id=<?= $value['id']?>&id2=<?=$value['hash_id']?>"><img src="<?=$value['image_1']?>" alt=""></a>
           <div class="top-meta">
               <span class="date"><span><?= date("d",strtotime($value['date_created'])) ?></span><?=date("M",strtotime($value['date_created']))?></span>
           </div>
       </div>
       <div class="blog-content">
           <div class="blog-meta">
               <span style="color:<?=$section1[0]['textcolor_text']?>"><i class="fas fa-user"></i><?= $value['input_author_name'] ?? "Admin"?></span>
               <span><i class="fas fa-book"></i><?=$category_data[$value['select_blog_category']]?></span>
           </div>
           <h3 class="title"><a href="read-blog?id=<?= $value['id']?>&id2=<?=$value['hash_id']?>"style="color:<?=$section1[0]['textcolor_title']?>"><?= $value['input_title']?></a></h3>
           <p style="color:<?=$section1[0]['textcolor_text']?>"><?= previewBody($value['text_content'], 50)?></p>
       </div>
       <div class="blog-btn">
           <a class="blog-btn-link" href="read-blog?id=<?= $value['id']?>&id2=<?=$value['hash_id']?>">Read Full Article <i class="fas fa-long-arrow-alt-right"></i></a>
       </div>
   </div>
   <!-- Single Blog End -->
<?php endforeach; ?>
  <?php
  return $result;
}
}

if ($page == "projects") {
  $blog = selectContentDescPagination($conn, 'panel_projects', ['visibility' => 'show'], 'id', $offset, $limit);
  // var_dump($blog);
  $result[] =  $blog;


  $category = selectContent($conn,"selection_project_category",["visibility" => "show"]);
      $category_data = [];
      foreach ($category as $key => $value) {
        $category_data[$value['id']] = $value['input_category_title'];
    }

?>
     <?php foreach($blog as $value):?>
       <!--Project Page One Single Start-->
       <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInLeft" data-wow-delay="100ms">
           <div class="project-one__single">
               <div class="project-one__inner">
                   <div class="project-one__img">
                       <!-- <img src="<?=$value['image_1']?>" alt="">                       -->
                         <div style="background-image: url(<?= $value['image_1']?>); background-size: cover; background-position: cover; padding-top: 100%; background-repeat: no-repeat">

                         </div>
                   </div>
                   <div class="project-one__arrow">
                       <a href="view-project/<?php echo $value['id'] ?>-<?php echo str_replace(' ', '_', $value['input_title']) ?>-<?php echo $value['hash_id'] ?>"><i class="icon-right-arrow"></i></a>
                   </div>
                   <div class="project-one__content">
                       <span class="project-one__tagline"><?=$category_data[$value['select_project_category']]?></span>
                       <h3 class="project-one__title"><a href="view-project/<?php echo $value['id'] ?>-<?php echo str_replace(' ', '_', $value['input_title']) ?>-<?php echo $value['hash_id'] ?>"><?=$value['input_title']?></a></h3>
                   </div>
               </div>
           </div>
       </div>
       <!--Project Page One Single Start-->
    <?php endforeach; ?>
  <?php
  return $result;
}
   ?>
