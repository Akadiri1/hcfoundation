<?php

$clean = array_map('trim', $_POST);
$key = $clean['query'];
// $tb = $clean['data'];

if($key == ""){
  die;
}


  $stmt1 = $conn->prepare("SELECT * FROM panel_article WHERE input_title LIKE :key OR text_content LIKE :key ");
  $bindKey = "%".$key."%";
  $stmt1->bindParam(":key",$bindKey);
    $stmt1->execute();
    $result1 = [];
    while($row1= $stmt1->fetch(PDO::FETCH_BOTH)){
      $result1[] = $row1;
    }

    $stmt2 = $conn->prepare("SELECT * FROM panel_insight WHERE input_title LIKE :key OR text_content LIKE :key ");
    $bindKey = "%".$key."%";
    $stmt2->bindParam(":key",$bindKey);
        $stmt2->execute();
        $result2 = [];
        while($row2= $stmt2->fetch(PDO::FETCH_BOTH)){
          $result2[] = $row2;
        }

        $stmt3 = $conn->prepare("SELECT * FROM panel_policy WHERE input_title LIKE :key OR text_content LIKE :key ");
        $bindKey = "%".$key."%";
        $stmt3->bindParam(":key",$bindKey);
            $stmt3->execute();
            $result3 = [];
            while($row3= $stmt3->fetch(PDO::FETCH_BOTH)){
              $result3[] = $row3;
            }

        $theResult = array_merge($result1, $result2, $result3);
    if($theResult){
      if($result2){
      ?>
      <?php foreach ($result2 as $key => $value): ?>
        <?php $bd = previewBody($value['text_content'],22);  ?>
        <div class="item-content" style="margin-left:0px">
          <div class="row">
            <div class="col-md-4">
                <img src="<?=$value['image_1']; ?>" alt="" height="100" width="100">
              </div>
						<div class="col-md-8">
              <div style="width: 100px; background-color: #D99578">
                <p class="text-center text-white">Insights</p>
              </div>
              <div class="p-2">
                <h4><a style="color: #D99578" target="_blank" href="/advisory/read-insight?id=<?= $value['select_insight_category'] ?>&&hash=<?= str_replace(' ','-',$value['input_title']).'-'.$value['hash_id'] ?>"> <?= ucwords(strtolower($value['input_title'])); ?></a></h4>

              </div>
						</div>
						<div class="p-2 px-5">
              <p><?= $bd; ?></p>
            </div>
					</div>

        </div>
        <div class="clearfix"></div><hr>
      <?php endforeach; ?>
    <?php }?>
    <?php if($result1){
      ?>
        <?php foreach ($result1 as $key => $value): ?>
              <?php $bd = previewBody($value['text_content'],10);  ?>
              <div class="item-content" style="margin-left:0px">
                <div class="row">
      						<div class="col-md-4">
      							<img src="<?=$value['image_1']; ?>" alt="" height="100" width="100">
      						</div>
      						<div class="col-md-8">
                    <div style="width: 100px; background-color: #D99578">
                      <p class="text-center text-white">Articles</p>
                    </div>
                    <div class="p-2">
                      <h4><a style="color: #D99578" target="_blank" href="/seun-fakuade/read-article?id=<?= $value['select_article_category'] ?>&&hash=<?= str_replace(' ','-',$value['input_title']).'-'.$value['hash_id'] ?>"> <?= ucwords(strtolower($value['input_title'])); ?></a></h4>

                    </div>
      						</div>
      						<div class="p-2 px-5">
                    <p><?= $bd; ?></p>
                  </div>
      					</div>

              </div>
              <div class="clearfix"></div><hr>
            <?php endforeach; ?>
          <?php } ?>

          <?php if($result3){
            ?>
              <?php foreach ($result3 as $key => $value): ?>
                    <?php $bd = previewBody($value['text_content'],10);  ?>
                    <div class="item-content" style="margin-left:0px">
                      <div class="row">
            						<div class="col-md-4">
            							<img src="<?=$value['image_1']; ?>" alt="" height="100" width="100">
            						</div>
            						<div class="col-md-8">
                          <div style="width: 100px; background-color: #D99578">
                            <p class="text-center text-white">Policy</p>
                          </div>
                          <div class="p-2">
                            <h4><a style="color: #D99578" target="_blank" href="/policy/read-policy?id=<?= $value['select_policy_category'] ?>&&hash=<?= str_replace(' ','-',$value['input_title']).'-'.$value['hash_id'] ?>"> <?= ucwords(strtolower($value['input_title'])); ?></a></h4>

                          </div>
            						</div>
            						<div class="p-2 px-5">
                          <p><?= $bd; ?></p>
                        </div>
            					</div>

                    </div>
                    <div class="clearfix"></div><hr>
                  <?php endforeach; ?>
                <?php } ?>

        <?php }else{ ?>
          <div class="composs-comments">
          <div class="comment-list">
          <div class="comments-big-message">
          <strong>No Result</strong>
          <p>Try other search keywords</p>
          </div>
          </div>
          </div>

        <?php }?>
