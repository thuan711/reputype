<?php 
    include('simple_html_dom.php');
    $url = 'http://thethao.vnexpress.net/photo/hau-truong/hom-nay-hoang-xuan-vinh-ve-nuoc-nguyen-tien-minh-quyet-dau-lin-dan-3452035.html';
    $html = file_get_html($url);
    $html->find('.block_thumb_slide_show',0)->outertext='';
    $html ->load($html ->save());
    $tieude = $html->find('.title_news',0);
    $noidung = $html->find('#article_content',0);
?>
<h1><?=$tieude->plaintext?></h1>
<div id="content"><?=$noidung->innertext?></div>