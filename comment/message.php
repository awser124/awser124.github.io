<?php
     
     //留言板的思路：1.先创建一个文件名，方便于存放写入的内容
     // 2.将表单中的内容赋值给一个变量
     //3.判断文件是否存在，将用户输入的值写进变量，打开文件的是时候注意选择对文件访问的操作
     //4.读取文件的内容,关闭文件
      
      
     header("Content-Type:text/html;charset=utf8");
     $filename = "message.txt";//创建一个文件的名字
      
     //如果用户提交了， 就写入文件， 按一定格式写入
     if(isset($_POST['dosubmit'])) {
     //字段的分隔使用||, 行的分隔使用[n]
     $mess = "{$_POST['username']}||".time()."||{$_POST['title']}||{$_POST['content']}[n]";
      
      
     writemessage($filename, $mess);//向文件写进内容
      
     }
      
     if(file_exists($filename)) {//判断文件 是否存在
     readmessage($filename);//读取文件的函数
     }
      
      
     function writemessage($filename, $mess) {
     $fp = fopen($filename, "a");//在尾部执行写的操作，且不删除原来的文件内容
     fwrite($fp, $mess);//写入文件
      
     fclose($fp);//关闭文件
     }
      
     function readmessage($filename) {
     $mess = file_get_contents($filename);
     $mess = rtrim($mess, "[n]");
      
     $arrmess = explode("[n]", $mess);
      
     foreach($arrmess as $m) {
     list($username, $dt ,$title, $content) = explode("||", $m);
      
     echo "{$username}, ".date("Y-m-d H:i").": <i>{$title}</i>, <u>{$content}</u><br><hr><br>";
     }
      
     }
      
 ?>

<title>留言板</title>
<style>
    .send {
        text-align: center;
    }
</style>
<form action="message.php" method="post" class="send">
用户: <input type="text" name="username" value="" /><br>
标题：<input type="text" name="title" value="" /><br>
内容：<textarea name="content" cols="40" rows="4"></textarea><br>
<input type="submit" name="dosubmit" value="留言" /><br>
</form>