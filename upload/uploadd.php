<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
include("../configuration.php");
$page=$_GET["page"];
$rank=$_GET["rank"];
?>
<!DOCTYPE html>
<html>
<head>
	<meta author = "">
	<title>upload</title>
  <link type="text/css" rel="stylesheet" href="../loginreg/loginreg.css" />
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
</head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<?php 
// grab authorID;
$query = "SELECT userID FROM userinfo where username = :user;";
$stmt = $db->prepare($query);
$exe = $stmt->execute(array(":user"=>$_SESSION["a"]));
$content = $stmt->fetch();
$authorID = $content["userID"];

// grab all uploads;
$query = "SELECT workID FROM U$authorID where type = 'upload';";
$stmt = $db->prepare($query);
$exe = $stmt->execute();
$content = $stmt->fetch();
//$uploadID = array();
$uploadlist = array();
while($content){
  //$uploadID[] = $content["workID"];
  // grab workname;
  $query = "SELECT workname FROM workinfo where workID = :workID;";
  $stmt1 = $db->prepare($query);
  $exe = $stmt1->execute(array(":workID"=>$content["workID"]));
  $content1 = $stmt1->fetch();
  $uploadlist[] = $content1["workname"];

  $content = $stmt->fetch();
}

//$uploadlist=array("asdf","32154fd","shit");
echo "<script>\nvar vlist = [];\nvar optionBox='';\n";
foreach ($uploadlist as $value) {
  echo "vlist.push('$value')\n";
}
echo "for (i = 0; i < vlist.length; i++) {\n
    optionBox = optionBox + '<option value='+vlist[i]+'>'+vlist[i]+'</option>'\n
}\n";
echo "</script>";


?>
<script>
$(document).ready(function(){
  $('.UpdateHandle').hide();
  $('.NewHandle').hide();
  var file_count = 1;
  //alert(optionBox);
  $('#new').click(function(){
    $('#update-box').remove();
    $('#addnew').remove();
    $('.UpdateHandle').hide();
    $('.NewHandle').show();
    $('#container').append('<div id=\"addnew\"><p><input type=\"text\" name=\"title\" value=\"\" placeholder=\"Title\" /></p><p><textarea width = "200px" height = "100px" type=\"text\" name=\"desc\" value="" placeholder=\"Description\" >Description</textarea></p>'
      +'<p>选择封面图片</p>'
      +'<p><input type=\"file\" name=\"cover\" id=\"bla\"></p><p>'
      +'<input type=\"radio\" name=\"type\" value=\"Manga\"> 漫画<input type=\"radio\" name=\"type\" value=\"Light Novel\"> 小说</p>'
      +'<p><input type=\"text\" name=\"name\" id=\"chporfile\" placeholder = \"chapter/file name\"></p>'
      +'选择上传文件:'
      +'<p><input type="file" name="fileToUpload1" id="fileToUpload1"></p>'
      +'</div>'
      );
  });
  $('#update').click(function(){
    $('#addnew').remove();
    $('#update-box').remove();
    $('.NewHandle').hide();
    $('.UpdateHandle').show();
    $('#container').append('<div id=\"update-box\" = ><p>'
      +'<select id = "select" name = "select">'+optionBox+'</select>'
      +'</p>'
      +'<p><input type=\"text\" name=\"name\" id=\"chporfile\" placeholder = \"chapter/file name\"></p>'
      +'选择上传文件:'
      +'<p><input type="file" name="fileToUpload1" id="fileToUpload1"></p>'
      +'</div>');
  });

  $('#addfile').click(function(){
    file_count++;
    $('#update-box').append('<p><input type="file" name="fileToUpload'+file_count+'" id="fileToUpload'+file_count+'"></p>');
    $('#addnew').append('<p><input type="file" name="fileToUpload'+file_count+'" id="fileToUpload'+file_count+'"></p>');
  });
  $('#remove').click(function(){
    $('#fileToUpload'+file_count).remove();
    file_count--;
  });
});

</script>

<body>
<div class="outer">
<div class="middle">
<div class="inner">
	<section class="container">
    <div class="upload">
      <h1>上传</h1>
      <?php echo "<form method='post' action='upload.php?page=$page&rank=$rank' enctype='multipart/form-data'>"?>
        <p><input type="radio" name="first" value="New work" id="new"> 新作
           <input type="radio" name="first" value="Update" id="update"> 更新</p>
        <p id="container" class = "three"></p>
        <p class="UpdateHandle NewHandle"><button type="button" id="addfile">添加一个文件</button>
        <button type="button" id="remove">删除一个文件</button></p>
        <p class="UpdateHandle NewHandle"><input type="submit" value="上传内容" name="submit"></input></p>
        <!--<p><input type="text" name="name" id="chporfile" placeholder = "chp/file name"></p>
        Select file to upload:
        <p><input type="file" name="fileToUpload" id="fileToUpload"></p>
        <p><input type="submit" value="Upload Content" name="submit"></p>-->
      </form>
      <?php
      echo "<p><a href='../hexa/hexa.php?page=$page&rank=$rank'>返回</a></p>";
      ?>
    </div>
  </section>
  </div>
  </div>
  </div>
</body>
</html>