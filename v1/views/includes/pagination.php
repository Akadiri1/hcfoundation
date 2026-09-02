<?php if($page > 1){
  echo "<li class='page-item' ><a class='page-link' href='?page=1'>First</a></li>";
}
?>
<li class="page-item" <?php if($page <= 1){ echo "class='disabled'"; } ?>>
<a class="page-link" <?php if($page > 1){
 echo "href='?page=$prevPage'";
} ?>>Previous</a>
</li>
<?php
if ($totalNumber <= 10){
for ($counter = 1; $counter <= $totalNumber; $counter++){
 if ($counter == $page) {
   echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";
 }else{
   echo "<li><a class='page-link' href='?page=$counter'>$counter</a></li>";
 }
}
}elseif ($totalNumber > 10){
if($page <= 4) {
 for ($counter = 1; $counter < 8; $counter++){
   if ($counter == $page) {
     echo "<li class='page-item active'><a>$counter</a></li>";
   }else{
     echo "<li><a class='page-link' href='?page=$counter'>$counter</a></li>";
   }
 }
 echo "<li page-item><a class='page-link'>...</a></li>";
 echo "<li page-item><a class='page-link' href='?page=$second_last'>$second_last</a></li>";
 echo "<li page-item><a class='page-link' href='?page=$totalNumber'>$totalNumber</a></li>";
}
}elseif($page > 4 && $page < $totalNumber - 4) {
echo "<li><a class='page-link' href='?page=1'>1</a></li>";
echo "<li><a class='page-link' href='?page=2'>2</a></li>";
echo "<li><a class='page-link'>...</a></li>";
for (
 $counter = $page - $totalNumber;
 $counter <= $page + $totalNumber;
 $counter++
) {
 if ($counter == $page) {
   echo "<li class='active'><a class='page-link'>$counter</a></li>";
 }else{
   echo "<li><a class='page-link' href='?page=$counter'>$counter</a></li>";
 }
}
echo "<li><a class='page-link'>...</a></li>";
echo "<li><a class='page-link' href='?page=$second_last'>$second_last</a></li>";
echo "<li><a class='page-link' href='?page=$total_pages'>$total_pages</a></li>";
}else {
echo "<li><a class='page-link' href='?page=1'>1</a></li>";
echo "<li><a class='page-link' href='?page=2'>2</a></li>";
echo "<li><a class='page-link'>...</a></li>";
for (
    $counter = $total_pages - 6;
    $counter <= $total_pages;
    $counter++
    ) {
    if ($counter == $page) {
echo "<li class='active'><a class='page-link'>$counter</a></li>";
}else{
       echo "<li><a class='page-link' href='?page=$counter'>$counter</a></li>";
}
    }
}
?>
<li class="page-item" <?php if($page >= $totalNumber){
echo "class='disabled'";
} ?>>
<a class="page-link" <?php if($page < $totalNumber) {
echo "href='?page=$nextPage'";
} ?>>Next</a>
</li>
<?php if($page < $totalNumber){
echo "<li ><a class='page-link' href='?page=$totalNumber'>Last &rsaquo;&rsaquo;</a></li>";
} ?>
