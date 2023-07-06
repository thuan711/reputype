<?php
    include('simple_html_dom.php');
    $url = 'https://dantri.com.vn/giao-duc-huong-nghiep/vu-lo-de-thi-sinh-8-thi-sinh-duoc-mom-de-can-xu-ly-the-nao-20230620004656478.htm';
    // $html ->load($html ->save()); 
    $html = file_get_html($url);
    // $noidung = $html->find('.article-title',0);
    foreach ($html->find('.article-excerpt a') as $element) {
        $title = $element->find('.article-title',0);
        $description = $element->plaintext;
        $link = $element->href;

        // Lấy hình ảnh từ đường dẫn gốc
        $imageElement = $element->find('img', 0);
        $image = $imageElement ? $imageElement->src : '';

        echo "Tiêu đề: " . $title . "<br>";
        echo "Mô tả: " . $description . "<br>";
        echo "Hình ảnh: " . $image . "<br>";
        echo "Đường dẫn: " . $link . "<br>";
        echo "<br>";
    }
?>