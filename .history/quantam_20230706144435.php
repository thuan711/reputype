<?php 
    include('simple_html_dom.php');
    $url = 'https://dantri.com.vn/giao-duc-huong-nghiep/vu-lo-de-thi-sinh-8-thi-sinh-duoc-mom-de-can-xu-ly-the-nao-20230620004656478.htm';
    // $html ->load($html ->save()); 
    $html = file_get_html($url);
    // $noidung = $html->find('.article-title',0);
    foreach ($html->find('.recommend-articles') as $element) {
        echo $element->plaintext ."<br>";
        // echo "<img src='".$element->src."'>";

    }