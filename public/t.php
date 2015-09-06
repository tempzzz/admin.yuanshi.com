<?
$url = 'http://cc.bearhk.info/htm_data/7/1508/1603933.html';
$contents = file_get_contents($url);
//echo $contents;

if(!preg_match('/2015\-08\-18 14:46/',$contents)){
    echo 0;
}else{
    echo 1;
}
