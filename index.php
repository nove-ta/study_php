<?php
    require('./func.php');
    $ret = getViewData($_POST);
    //var_dump($ret);
    $hand_list = $ret["hand_list"];

    $jibun_str = $ret['jibun_str'];
    $aite_str = $ret['aite_str'];
    $judge = $ret['judge'];
?>
<body>
<h3>じゃんけん</h3>
<form action="/test/index.php" method="post">
<select name="jibun">
<?php foreach($hand_list as $key => $val){
    echo '<option value="'.$key.'">'.$val.'</option>';
}
?>
</select>
<input type="submit" value="送信">
</form>
<hr/>
<h3>
<?php
echo 'あなた：'.$jibun_str.'<br/>';
echo 'あいて：'.$aite_str.'<br/>';
echo '<br/>';
echo '判定 :'.$judge;
?>
</body>