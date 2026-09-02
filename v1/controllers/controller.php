<?php

function MCK_Clarity()
{
  $clarityId = getenv("CLARITY_ID");

  if (empty($clarityId)) {
    return false;
  }

  echo "
  <script type='text/javascript'>
    (function(c,l,a,r,i,t,y){
        c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
        t=l.createElement(r);t.async=1;t.src='https://www.clarity.ms/tag/'+i;
        y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
      })(window, document, 'clarity', 'script', '{$clarityId}');
  </script>
  ";
}

function loadADMCIcons(){
  echo '

  <link rel="stylesheet" href="/da/assets/fonts/material/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="/da/assets/fonts/fontawesome/css/fontawesome-all.min.css">
  <link rel="stylesheet" href="/da/assets/fonts/flag/css/flag-icon.min.css">
  <link rel="stylesheet" href="/da/assets/fonts/feather/css/feather.css">
  <link rel="stylesheet" href="/da/assets/fonts/datta/datta-icon.css">
  <link rel="stylesheet" href="/da/assets/fonts/simple-line-icons/simple-line-icon.css">
  <link rel="stylesheet" href="/da/assets/fonts/themify/themify.css">
  ';
}

if (!function_exists('getallheaders')) {
    function getallheaders() {
    $headers = [];
    foreach ($_SERVER as $name => $value) {
        if (substr($name, 0, 5) == 'HTTP_') {
            $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
        }
    }
    return $headers;
    }
}



  function fetchData($dbconn, $table, $param = null, $order = null, $count = false){
    //Do not add offset if you want to get count only

    // $table = $table;
    $orderColumnArg = $order['order_column'] ?? false;
    $limitArg = $order['limit'] ?? false;

    $offsetArg = isset($order['offset']) ? $order['offset']: false;

    if (!$limitArg && $offsetArg) {
        $limitCount = $dbconn->prepare("SELECT COUNT(*) AS count FROM $table");
        $limitCount->execute();
        $limitArg = $limitCount->fetch()['count'];
    }

    if (isset($order['type'])) {
        $orderTypeArg = strtoupper($order['type']);
    }else{

      $orderTypeArg = false;
    }
// var_dump($order, $offsetArg);

    $orderQueryString = "";

    if ($count == true) {
      $query = "SELECT COUNT(*) AS count FROM `$table` ";

    }else{
      $query = "SELECT * FROM `$table` ";
    }

        $bindData = [];


        if ($orderColumnArg) {
            if (is_array($orderColumnArg)) {
                $orderCol = implode(", ", $orderColumnArg);
            }else{
                $orderCol = $orderColumnArg;
            }

            $orderQueryString .= " ORDER BY ".$orderCol;
        }

        if ($orderTypeArg) {
            $orderQueryString .= " ".strtoupper($orderTypeArg);
        }

        if ($limitArg && !is_bool($limitArg)) {
            // $orderQueryString .= " LIMIT $limitArg";
            $orderQueryString .= " LIMIT :arg_limit";
            $bindData['arg_limit'] = $limitArg;

        }

        if ($offsetArg && !is_bool($offsetArg)) {
            // $orderQueryString .= " OFFSET $offsetArg";
            $orderQueryString .= " OFFSET :arg_offset";
            $bindData['arg_offset'] = $offsetArg;

        }


        if (count($param) > 0) {
        $query.="WHERE ";

            if (isset($param['query_and']) || isset($param['query_or']) || isset($param['query_and_not']) || isset($param['query_not_or'])) {
            $andCols = [];
            $andNotCols= [];
            $orCols = [];
            $orNotCols = [];

            if ($param['query_and'] ?? false) {
                // code...
                foreach ($param['query_and'] as $andColKey => $andColValue) {
                    $andCols []= $andColKey." = :".$andColKey."_and";
                    $bindData[$andColKey."_and"] = $andColValue;
                }
            }

            if ($param['query_and_not'] ?? false) {
                // code...
                foreach ($param['query_and_not'] as $andNotColKey => $andNotColValue) {
                    $andNotCols []= $andNotColKey." = :".$andNotColKey."_and_not";
                    $bindData[$andNotColKey."_and_not"] = $andNotColValue;
                }
            }

            if ($param['query_or'] ?? false) {

                foreach ($param['query_or'] as $orColKey => $orColValue) {
                    $orCols []= $orColKey." = :".$orColKey."_or";
                    $bindData[$orColKey."_or"] = $orColValue;

                }
            }

            if ($param['query_or_not'] ?? false) {

                foreach ($param['query_or_not'] as $orNotColKey => $orNotColValue) {
                    $orNotCols []= $orNotColKey." = :".$orColKey."_or_not";
                    $bindData[$orNotColKey."_or_not"] = $orNotColValue;

                }
            }



            $andColsString = implode(" AND ", $andCols);
            $andNotColsString = ((count($andNotCols) > 0) ? " NOT " : "" ).implode(" AND NOT ", $andNotCols);
            $orColsString = implode(" OR ", $orCols);
            $orNotColsString = ((count($orNotCols) > 0) ? " NOT " : "" ).implode(" OR NOT ", $orNotCols);

            if (count($andCols) > 0  && count($andNotCols) > 0 && count($orCols) > 0  && count($orNotCols) > 0) {
                $allColString =  $andColsString." AND ( NOT ".$andNotColsString.")"." AND (".$orColsString.")"." AND ( ".$orNotColsString.")";
            }elseif(count($andCols) > 0  && count($andNotCols) > 0 && count($orCols) > 0){
                $allColString =  $andColsString." AND (".$andNotColsString.")"." AND (".$orColsString.")";

            }elseif(count($andCols) > 0  && count($andNotCols) > 0){
                $allColString =  $andColsString." AND (".$andNotColsString.")";

            }else{
                $allColString = $andColsString.$andNotColsString.$orColsString.$orNotColsString;
            }


            $query .= $allColString;

        }else{
            $cols = [];

            foreach ($param as $colKey => $colValue) {
                    $cols []= $colKey." = :".$colKey;
                    $bindData[$colKey] = $colValue;

                }

            $colsString = implode(" AND ", $cols);

            $query .= $colsString;


        }

    }
    $query.= $orderQueryString;

    // var_dump($query, $bindData, $orderQueryString);
    // var_dump($query);


    $queryStmt = $dbconn->prepare($query);

    foreach ($bindData as $key => $value) {
        if ($key == "arg_limit" || $key == "arg_offset") {
            $value = intval($value);
            $queryStmt->bindValue($key, $value, PDO::PARAM_INT);
        }else{
            // var_dump($value, $key);
            $queryStmt->bindValue($key, $value);
        }

    }
    try {

      $queryStmt->execute();
      
      if ($count == true) {
        // var_dump($queryStmt->fetch());
        $dataResult = $queryStmt->fetch()['count'];
      }else{
        $dataResult = $queryStmt->fetchAll();
      }
    } catch (Exception $e) {
        if ($PRODUCTION_MODE ?? true) {
            // echo $queryStmt->queryString;
            die($e->getMessage());
        }else{
            die("An error occured check passed data.");
        }
      // $dataResult = ["error"=>"An error occured"];
    }

     // $queryStmt->debugDumpParams();
     // echo $queryStmt->queryString;
     // var_dump( $queryStmt->errorInfo());
    // var_dump($query, $queryStmt, $bindData);
    return $dataResult;

}



function cleanDecodeDate ($date = null, $type = null) {
  if ($date == null) {
    $date = date("Y-m-d");
  }

  if ($type != null) {
    $type = strtoupper($type);
  }

  if (is_numeric($date)) {
    $dateToInteger = $date;
  }else{

    $dateToInteger = strtotime($date);
  }

  $returnDate = [];

  $returnDate['hour'] =  date("h", $dateToInteger);
  $returnDate['minutes'] =  date("i", $dateToInteger);
  $returnDate['seconds'] =  date("s", $dateToInteger);
  $returnDate['meridiem'] =  date("A", $dateToInteger);

  $returnDate['day_abbr'] = date("D", $dateToInteger);
  $returnDate['day'] = date("l", $dateToInteger);
  $returnDate['day_int'] = date("d", $dateToInteger);
  $returnDate['day_int_suffix'] = date("jS", $dateToInteger);
  $returnDate['day_in_year'] = date("z", $dateToInteger);

  $returnDate['day_in_week'] = date("N", $dateToInteger);

  $returnDate['month_abbr'] = date("M", $dateToInteger);
  $returnDate['month_int'] = date("m", $dateToInteger);
  $returnDate['month'] = date("F", $dateToInteger);
  $returnDate['month_count'] = date("t", $dateToInteger);

  $returnDate['year'] = date("Y", $dateToInteger);
  $returnDate['year_short'] = date("y", $dateToInteger);


  if ($type == "FULL") {
    return $returnDate;
  }elseif($type == "FULL_TIME"){
    return $returnDate['hour'].":".$returnDate['minutes'].":".$returnDate['seconds']." ".$returnDate['meridiem'];
  }elseif($type == "TIME"){
    return $returnDate['hour'].":".$returnDate['minutes']." ".$returnDate['meridiem'];
  }else{
    return $returnDate['day_abbr'].", ".$returnDate['day_int']." ".$returnDate['month_abbr']." ".$returnDate['year'];
  }


}


function urlString($urlToString){
  $urlString = (str_replace([' ', '+'], '-', strtolower(urlencode($urlToString))));
  return $urlString;
}



function stringStartWith($string, $stringToSearch){
    if(strpos($string, $stringToSearch) === 0){
      return true;
    }else{
      return false;
    }

  }


function previewBodyWithElipsces($string, $count = 50, $strip = true, $url_param = ['link'=>'', 'color'=>"white"]){
  if ($strip == true) {
    $string = strip_tags($string);
  }

  $original_string = $string;

  // var_dump($original_string);

  $words = explode(' ', $original_string);

  if (isset($url_param['color'])) {
    $url_color = "style='color:".$url_param['color']." !important;'";
  }else{
    $url_color = "";
  }

  if (isset($url_param['text'])) {
    // code...
    $url_text = $url_param['text'];
  }else{
    $url_text = "read more";
  }

  if (isset($url_param['link'])) {
    if (!empty($url_param['link'])) {
      // code...
      $url = " <a href='".$url_param['link']."'".$url_color.">".$url_text."</a>";
    }else{
      $url = "";
    }
  }else{
    $url = "";
  }


// var_dump(count($words), $count);
  if(count($words) > $count){
    $words = array_slice($words, 0, $count);
    $string = implode(' ', $words)."...";
  }
    return $string.$url;

}



function decodeDate($date){
  $split = explode('-',$date);
  $month = $split[1];
  $day = $split[2];
  $year = $split[0];
  if($month == 1 ){
    $month = "January";
  }
  if($month == 2 ){
    $month = "February";
  }
  if($month == 3 ){
    $month = "March";
  }
  if($month == 4){
    $month = "April";
  }
  if($month == 5){
    $month = "May";
  }
  if($month == 6 ){
    $month = "June";
  }
  if($month == 7 ){
    $month = "July";
  }
  if($month == 8 ){
    $month = "August";
  }
  if($month == 9 ){
    $month = "September";
  }
  if($month == 10 ){
    $month = "October";
  }
  if($month == 11 ){
    $month = "November";
  }
  if($month == 12 ){
    $month = "December";
  }
  $newDate = $month.' '.$day.', '.$year;
  return $newDate;
}
function ForumInfo($dbconn,$sess){
  $stmt = $dbconn->prepare("SELECT * FROM users WHERE hash_id = :sid");
  $data = [
    ':sid' => $sess
  ];
  $stmt->execute($data);
  $row = $stmt->fetch(PDO::FETCH_BOTH);
  return $row;
}
function insert($conn, $table, $parameters){

  array_pop($parameters);
  // var_dump($parameters);
  $sql = sprintf('INSERT INTO %s (%s) VALUES(%s)',
  $table,
  implode(', ',array_keys($parameters)), ':'.implode(',:',array_keys($parameters))
);
// //die(var_dump($sql));
$stmt =  $conn->prepare($sql);
$stmt->execute($parameters);
}
// function displayErrors($error, $field)
// {
//   $result= "";
//   if (isset($error[$field]))
//   {
//     $result = '<span style="color:red">'.$error[$field].'</span>';
//   }
//   return $result;
// }

function columnSummation($conn,$column,$table){
  $stmt = $conn->prepare("SELECT $column FROM $table");
  $stmt->execute();
  $plus = 0;
  // die(var_dump($row = $stmt->fetch(PDO::FETCH_BOTH)));
  while($row = $stmt->fetch(PDO::FETCH_BOTH)){
    $plus += $row[$column];
  }
  // die(var_dump($plus));
  return $plus;
}
function columnPrySummation($conn,$column,$table){
  $pry = "primary";
  $stmt = $conn->prepare("SELECT $column FROM $table WHERE category=:pry");

  $stmt->bindParam(":pry",$pry);
  $stmt->execute();
  $plus = 0;
  // die(var_dump($row = $stmt->fetch(PDO::FETCH_BOTH)));
  while($row = $stmt->fetch(PDO::FETCH_BOTH)){
    $plus += $row[$column];
  }
  // die(var_dump($plus));
  return $plus;
}

function totalCount($conn,$table){
  $stmt = $conn->prepare("SELECT * FROM $table");
  $stmt->execute();
  return $stmt->rowCount();
}
function totalPryCount($conn,$table){
  $pry = "primary";
  $stmt = $conn->prepare("SELECT * FROM $table WHERE category=:pry");
  $stmt->bindParam(":pry",$pry);
  $stmt->execute();
  return $stmt->rowCount();
}

function totalCategoryCount($conn,$table,$column,$value){
  $stmt = $conn->prepare("SELECT * FROM $table WHERE $column=:value");
  $stmt->bindParam(':value',$value);
  $stmt->execute();
  return $stmt->rowCount();
}

function cleans($string){
  $string = str_replace(array('[\', \']'), '', $string);
  $string = preg_replace('/\[.*\]/U', '', $string);
  $string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);
  $string = htmlentities($string, ENT_COMPAT, 'utf-8');
  $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string );
  $string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/') , '-', $string);
  return strtolower(trim($string, '-'));
}









function cleanTime($time){
  $timestamp = strtotime($time) + 60*60;

  $time = date('H:i:s', $timestamp);
  return $time;

}
function getForumCategory($dbconn){
  $stmt = $dbconn->prepare("SELECT * FROM category");
  $stmt->execute();
  while($row = $stmt->fetch(PDO::FETCH_BOTH)){
    extract($row);

    echo '<li><a href="/category/'.$hash_id.'">'.$category_name.' &nbsp;<span class="badge pull-right">'.categoryCount($dbconn,$row['hash_id']).'</span></a></li>';
  }
}
function getMyForum($dbconn,$id){
  $stmt = $dbconn->prepare("SELECT * FROM topic WHERE user_id=:hid");
  $stmt->bindParam(":hid",$id);
  $stmt->execute();
  while($row = $stmt->fetch(PDO::FETCH_BOTH)){
    extract($row);
    $post = cleans($title);
    echo '<div class="divline"></div>
    <div class="blocktxt">
    <a href="/topic/'.$post.'-'.$row['hash_id'].'">'.strtoupper(strtolower($row['title'])).'</a>
    </div>';
  }
}

function previewBody($string, $count){
  $original_string = $string;
  $words = explode(' ', $original_string);
  if(count($words) > $count){
    $words = array_slice($words, 0, $count);
    $string = implode(' ', $words)."...";
  }
  return strip_tags($string);
}


function insertSafe($conn, $table, $parameters){
  try {
    // array_pop($parameters);
    // var_dump($parameters);
    $sql = sprintf('INSERT INTO %s (%s) VALUES(%s)',
    $table,
    implode(', ',array_keys($parameters)), ':'.implode(',:',array_keys($parameters))
  );
  // //die(var_dump($sql));
  $stmt =  $conn->prepare($sql);
  $stmt->execute($parameters);
} catch (PDOException $e) {
  die($e);
  die("Error: Try again After Some Times");
}
}
function insertContent($conn, $table, $parameters){
  try {

    // var_dump($parameters);
    $sql = sprintf('INSERT INTO %s (%s) VALUES(%s)',
    $table,
    implode(', ',array_keys($parameters)), ':'.implode(',:',array_keys($parameters))
  );
  // //die(var_dump($sql));
  $stmt =  $conn->prepare($sql);
  $stmt->execute($parameters);
} catch (PDOException $e) {
  // die($e);
  die("Error: Try again After Some Times");
}
}

// function update($dbconn, $table, $parameters,$column,$value,$locat){
//
//
// try {
//   function getVal($param){
//   $result = [];
//   foreach($param as $col => $val){
//       $result[] = "$col = :$col";
//     }
//     $new = implode(', ', $result);
//     return $new;
// }
//   function getVal2($param){
//   $result = [];
//   foreach($param as $col => $val){
//       $result[] = "$col = :$col";
//     }
//     $new = implode(' AND ', $result);
//     return $new;
// }
//
//
// array_pop($parameters);
// $what = getVal($parameters);
// $vall = getVal2($value);
//
//   // var_dump($parameters);
//   $sql = sprintf('UPDATE %s SET %s',
//       $table, $what
//   );
//   $sql .= " WHERE ".$vall;
//   // //die(var_dump($sql));
// $stmt =  $dbconn->prepare($sql);
// $newt = $parameters + $value;
// // die(var_dump($newt));
// $stmt->execute($newt);
// } catch (PDOException $e) {
//   die("Error Occured");
// }
//
// if($table == "admin"){
//   $success = "Profile Successfully Edited";
//   $succ = preg_replace('/\s+/', '_', $success);
//   header("Location:/$locat");
// }else {
//   $success = "Edited";
//   $succ = preg_replace('/\s+/', '_', $success);
//   header("Location:/$locat?success=$succ");
// }
//
//
//
// }


// function compressImage($files, $name, $quality, $upDIR ) {
//   // die(var_dump($files[$name]['type']));
//   $rnd = rand(0000000, 9999999);
//   $strip_name = preg_replace("/[^.a-zA-Z0-9]/", "_",$_FILES[$name]['name'] );
//   $filename = time()."mail".$strip_name;
//   $destination_url = $upDIR.$filename;
//   $info = getimagesize($files[$name]['tmp_name']);
//   if ($info['mime'] == 'image/jpeg')
//   $image = imagecreatefromjpeg($files[$name]['tmp_name']);
//   elseif ($info['mime'] == 'image/gif')
//   $image = imagecreatefromgif($files[$name]['tmp_name']);
//   elseif ($info['mime'] == 'image/png')
//   $image = imagecreatefrompng($files[$name]['tmp_name']);
//   imagejpeg($image, $destination_url, $quality);
//   $img['upload'] = $destination_url;
//   return $img;
// }
function compressImage2($files, $name, $quality, $upDIR ) {
  // die(var_dump($files[$name]['type']));

  $rnd = rand(0000000, 9999999);
  $strip_name = preg_replace("/[^.a-zA-Z0-9]/", "_",$_FILES[$name]['name'] );
  $filename = time()."mail".$strip_name;
  $destination_url = $upDIR.$filename;
  $thumb_url = 'thumbs/'.$filename;
  $info = getimagesize($files[$name]['tmp_name']);
  if ($info['mime'] == 'image/jpeg')
  $image = imagecreatefromjpeg($files[$name]['tmp_name']);
  elseif ($info['mime'] == 'image/gif')
  $image = imagecreatefromgif($files[$name]['tmp_name']);
  elseif ($info['mime'] == 'image/png')
  $image = imagecreatefrompng($files[$name]['tmp_name']);


  imagejpeg($image, $destination_url, 90);
  imagejpeg($image, $thumb_url,30);
  $img['upload'] = $destination_url;
  $img['thumb'] = $thumb_url;
  return $img;
}

function formatWhereClause($columnParam){
  $result = [];
  foreach ($columnParam as $key => $value) {
    $result[] = "$key = :$key";
  }
  $newResult = implode(' AND ', $result);
  return $newResult;
}

function selectContentDescPagination($dbconn,$table,$columnWhere,$order,$offset,$limit){
  $vall = formatWhereClause($columnWhere);
  try{

    // $what = getVal($parameters);

    // var_dump($parameters);
    $sql = sprintf('SELECT * FROM %s',
    $table
  );

  if(count($columnWhere) > 0){
    $sql .= " WHERE ".$vall;
  }
  $sql.= " ORDER BY ".$order." DESC LIMIT ".$offset.", ".$limit;

  //die(var_dump($sql));
  $stmt =  $dbconn->prepare($sql);
  $newt = $columnWhere;
  // die(var_dump($newt));
  if(count($columnWhere) > 0){
    $stmt->execute($newt);
  }else{
    $stmt->execute();
  }

  $result = [];
  while($row = $stmt->fetch(PDO::FETCH_BOTH)){
    $result[] = $row;
  }

  return $result;
} catch (PDOException $e) {
  die($e);
  // die("Error Occured");
}
}

function selectTableContent2($dbconn,$table,$column,$columnWhere){
  $vall = formatWhere($columnWhere);
  $column = implode(',',$column);
  try{

    // $what = getVal($parameters);

    // var_dump($parameters);
    $sql = sprintf('SELECT %s FROM %s',
    $column,$table
  );

  if(count($columnWhere) > 0){
    $sql .= " WHERE ".$vall;
  }

  // die(var_dump($sql));
  $stmt =  $dbconn->prepare($sql);
  $newt = $columnWhere;
  // die(var_dump($newt));
  if(count($columnWhere) > 0){
    $stmt->execute($newt);
  }else{
    $stmt->execute();
  }

  // $result = [];
  $row = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);




  return $row;
} catch (PDOException $e) {
  // die("Error Occured");
  die($e);

}
}

function deleteContent($dbconn,$table,$columnWhere){

  // die($columnWhere);
  try {

    // $what = getVal($parameters);
    $vall = formatWhere($columnWhere);

    // var_dump($parameters);
    $sql = sprintf('DELETE FROM %s',
    $table
  );
  $sql .= " WHERE ".$vall;


  //die(var_dump($sql));
  $stmt =  $dbconn->prepare($sql);
  $newt = $columnWhere;
  // die(var_dump($newt));

  $stmt->execute($newt);

} catch (PDOException $e) {
  // die("Error Occured");
  die($e);
}

}

function selectContent($dbconn,$table,$columnWhere){
  $vall = formatWhere($columnWhere);
  try{

    // $what = getVal($parameters);

    // var_dump($parameters);
    $sql = sprintf('SELECT * FROM %s',
    $table
  );

  if(count($columnWhere) > 0){
    $sql .= " WHERE ".$vall;
  }

  //die(var_dump($sql));
  $stmt =  $dbconn->prepare($sql);
  $newt = $columnWhere;
  // die(var_dump($newt));
  if(count($columnWhere) > 0){
    $stmt->execute($newt);
  }else{
    $stmt->execute();
  }

  $result = [];
  while($row = $stmt->fetch(PDO::FETCH_BOTH)){
    $result[] = $row;
  }

  return $result;
} catch (PDOException $e) {
  // die("Error Occured");
  die($e);
}
}
function selectContentDesc($dbconn,$table,$columnWhere,$order,$limit){
  $vall = formatWhere($columnWhere);
  try{

    // $what = getVal($parameters);

    // var_dump($parameters);
    $sql = sprintf('SELECT * FROM %s',
    $table
  );

  if(count($columnWhere) > 0){
    $sql .= " WHERE ".$vall;
  }
  $sql.= " ORDER BY ".$order." DESC LIMIT ".$limit;

  //die(var_dump($sql));
  $stmt =  $dbconn->prepare($sql);
  $newt = $columnWhere;
  // die(var_dump($newt));
  if(count($columnWhere) > 0){
    $stmt->execute($newt);
  }else{
    $stmt->execute();
  }

  $result = [];
  while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    $result[] = $row;
  }

  return $result;
} catch (PDOException $e) {
  die($e);
  // die("Error Occured");
  die($e);
}
}
function selectContentAsc($dbconn,$table,$columnWhere,$order,$limit){
  $vall = formatWhere($columnWhere);
  try{

    // $what = getVal($parameters);

    // var_dump($parameters);
    $sql = sprintf('SELECT * FROM %s',
    $table
  );

  if(count($columnWhere) > 0){
    $sql .= " WHERE ".$vall;
  }
  $sql.= " ORDER BY ".$order." ASC LIMIT ".$limit;

  //die(var_dump($sql));
  $stmt =  $dbconn->prepare($sql);
  $newt = $columnWhere;
  // die(var_dump($newt));
  if(count($columnWhere) > 0){
    $stmt->execute($newt);
  }else{
    $stmt->execute();
  }

  $result = [];
  while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    $result[] = $row;
  }

  return $result;
} catch (PDOException $e) {
  // die($e);
  // die("Error Occured");
}
}
function selectTableContent($dbconn,$table,$column,$columnWhere){
  $vall = formatWhere($columnWhere);
  $column = implode(',',$column);
  try{

    // $what = getVal($parameters);

    // var_dump($parameters);
    $sql = sprintf('SELECT %s FROM %s',
    $column,$table
  );

  if(count($columnWhere) > 0){
    $sql .= " WHERE ".$vall;
  }

  // die(var_dump($sql));
  $stmt =  $dbconn->prepare($sql);
  $newt = $columnWhere;
  // die(var_dump($newt));
  if(count($columnWhere) > 0){
    $stmt->execute($newt);
  }else{
    $stmt->execute();
  }

  $result = [];
  while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    $result[] = $row;
  }

  return $result;
} catch (PDOException $e) {
  // die("Error Occured");
  die($e);
}
}


function formatParam($param){
  $result = [];
  foreach($param as $col => $val){
    $result[] = "$col = :$col";
  }
  $new = implode(', ', $result);
  return $new;
}
function formatWhereParam($param){
  $result = [];
  foreach($param as $col => $val){
    $cola = $col."a";
    $result[$cola] = $val;
  }
  // $new = implode(', ', $result);
  return $result;
}
function formatWhere($param){
  $result = [];
  foreach($param as $col => $val){
    $result[] = "$col = :$col";
  }
  $new = implode(' AND ', $result);
  return $new;
}
function formatPutWhere($param){
  $result = [];
  foreach($param as $col => $val){
    $result[] = "$col = :$col"."a";
  }
  $new = implode(' AND ', $result);
  return $new;
}

function updateContent($dbconn, $table, $parameters,$columnWhere){
  try {



  // array_pop($parameters);
  $what = formatParam($parameters);
  $columnWhere2 = formatWhereParam($columnWhere);
  $vall = formatPutWhere($columnWhere);

    // var_dump($parameters);
    $sql = sprintf('UPDATE %s SET %s',
        $table, $what
    );
    $sql .= " WHERE ".$vall;
    // var_dump($sql);
  $stmt =  $dbconn->prepare($sql);
  $newt = $parameters + $columnWhere2;
  // die(var_dump($newt));
  $stmt->execute($newt);
  } catch (PDOException $e) {
    if (isset($_SESSION['debug'])) {
    die($e);
  }else{
      die("Error: Try again After Some Times");
  }
  }
}




function say($value){
  echo "<p style='color:red'>*".$value."</p>";
}
function commentCount($dbconn,$hid){
  $stmt = $dbconn->prepare("SELECT * FROM reply WHERE topic_id=:ti");
  $stmt->bindParam(":ti",$hid);
  $stmt->execute();
  return $stmt->rowCount();
}
function categoryCount($dbconn,$hid){
  $stmt = $dbconn->prepare("SELECT * FROM topic WHERE category=:ti");
  $stmt->bindParam(":ti",$hid);
  $stmt->execute();
  return $stmt->rowCount();
}



function base64url_encode($s) {
  return str_replace(array('+', '/'), array('-', '_'), base64_encode($s));
}

function base64url_decode($s) {
  return base64_decode(str_replace(array('-', '_'), array('+', '/'), $s));
}

function authenticate($session, $url){
  if(!isset ($session)){
    header("Location: /$url?err=You_have_not_logged_in");
  }
}

function shortContent($content){
 $body = $content;
 $string = strip_tags($body);
 if (strlen($string) > 50){
   $stringCut = substr($string, 0, 50);
   $endPoint = strrpos($stringCut, ' ');
   $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
   $string .= '...';
 }
 return $string;
}


function doUserRegisterfor($dbconn, $input){
  try{
  $rnd = rand(0000000000,9999999999);
    $split = $input['firstname'];
    $id = $rnd.cleans($split);
  $hash_id = time().str_shuffle($id);
  $team = 0;
  // $point = 0;
  $admin = 0;
  $hash = password_hash($input['pword'], PASSWORD_BCRYPT);
  #insert data
  $stmt = $dbconn->prepare("INSERT INTO panel_members(input_firstname,input_lastname,input_email,input_phone_number,input_address,input_state,input_city,input_password,hash_id,verify,time_created,date_created) VALUES(:fn,:ln,:e,:pn,:ad,:st,:ci,:h,:hid,:vf,NOW(),NOW())");
  #bind params...
  $data = [
  ':fn' => $input['firstname'],
  ':ln' => $input['lastname'],
  ':e' => $input['email'],
  ':pn' => $input['phone'],
  ':ad' => $input['address'],
  ':st' => $input['state'],
  ':ci' => $input['city'],
  ':h' => $hash,
  ':hid' => $hash_id,
  ':vf' => "NO",
];
$stmt->execute($data);
 return $hash_id;

// $result = [];
// $token_s = 1;
// $ran = rand(0000000000,999999999);
// $tim = time();
// $process = $ran."MckodevGovernmentDashboardVerification".$hash_id;
// $token = $tim."_".str_shuffle($process);
//
//
// $updatever = $dbconn->prepare("INSERT INTO verify VALUES(NULL,:em,:tk,:tks,:en)");
// $data2 = [
// 'em' => $hash_id,
// 'tk' => $token,
// 'tks' => $token_s,
// 'en' => $input['email']
// ];
// $updatever->execute($data2);
// $result[] = $token;
// return $result;
//
//
}catch(PDOException $e){
  die($e->getMessage());

}

};
?>
