<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Page;
/**
 * @desc 日志记录
 */
class LogController extends BaseController {

    public function __construct(){
        parent::__construct();
    }



    /**
     * @isMenu 0
     * @desc 写入日志
     */
    public static function __write(){
        $db = D('Logs');
        $data = array(
            'uid'=>session('uid'),
            'username'=>session('username'),
            'ip'=>get_client_ip(),
            'createtime'=>$_SERVER["REQUEST_TIME"],
            'request_uri'=>$_SERVER['REQUEST_URI'],
            'c'=>strtolower(CONTROLLER_NAME),
            'm'=>strtolower(ACTION_NAME)
        );
        $db->add($data);
    }
    /*
showHTML() {
    if(0 == $this->totalRows) return '';


$this->parameter[$this->p] = '[PAGE]';
$this->url = U(ACTION_NAME, $this->parameter);

$this->totalPages = ceil($this->totalRows / $this->listRows); //总页数
if(!empty($this->totalPages) && $this->nowPage > $this->totalPages) {
$this->nowPage = $this->totalPages;
}


$now_cool_page      = $this->rollPage/2;
$now_cool_page_ceil = ceil($now_cool_page);
$this->lastSuffix && $this->config['last'] = $this->totalPages;

//上一页
$up_row  = $this->nowPage - 1;  //<i class="fa-angle-left"></i>
$up_page = $up_row > 0 ? '<li><a href="' . $this->url($up_row) . '"><i class="fa-angle-left"></i></a></li>' : '';

//下一页
$down_row  = $this->nowPage + 1;
$down_page = ($down_row <= $this->totalPages) ? '<li><a href="' . $this->url($down_row) . '"><i class="fa-angle-right"></i></a></li>' : '';

//第一页
$the_first = '';
if($this->totalPages > $this->rollPage && ($this->nowPage - $now_cool_page) >= 1){
    $the_first = '<li><a href="' . $this->url(1) . '">First</a></li>';
}

//最后一页
$the_end = '';
if($this->totalPages > $this->rollPage && ($this->nowPage + $now_cool_page) < $this->totalPages){
    $the_end = '<li><a href="' . $this->url($this->totalPages) . '">End</a></li>';
}

//数字连接
$link_page = "";
for($i = 1; $i <= $this->rollPage; $i++){
    if(($this->nowPage - $now_cool_page) <= 0 ){
        $page = $i;
    }elseif(($this->nowPage + $now_cool_page - 1) >= $this->totalPages){
        $page = $this->totalPages - $this->rollPage + $i;
    }else{
        $page = $this->nowPage - $now_cool_page_ceil + $i;
    }
    if($page > 0 && $page != $this->nowPage){

        if($page <= $this->totalPages){
            $link_page .= '<li><a href="' . $this->url($page) . '">' . $page . '</a></li>';
        }else{
            break;
        }
    }else{
        if($page > 0 && $this->totalPages != 1){
            $link_page .= '<li class="active"><a href="#">' . $page . '</a></li>';
        }
    }
}

//替换分页内容
$page_str = str_replace(
    array('%HEADER%', '%NOW_PAGE%', '%UP_PAGE%', '%DOWN_PAGE%', '%FIRST%', '%LINK_PAGE%', '%END%', '%TOTAL_ROW%', '%TOTAL_PAGE%'),
    array($this->config['header'], $this->nowPage, $up_page, $down_page, $the_first, $link_page, $the_end, $this->totalRows, $this->totalPages),
    $this->config['theme']);
return "<ul class=\"pagination\">{$page_str}</ul>";
}
     */
}