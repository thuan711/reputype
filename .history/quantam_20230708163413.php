<?php

// Sử dụng thư viện cURL để tải nội dung trang web
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://dantri.com.vn/giao-duc-huong-nghiep/vu-lo-de-thi-sinh-8-thi-sinh-duoc-mom-de-can-xu-ly-the-nao-20230620004656478.htm');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

// Tạo một đối tượng DOM để phân tích nội dung HTML
$dom = new DOMDocument();
@$dom->loadHTML($response);
$xpath = new DOMXPath($dom);
// Lấy các phần tử trong trang web dựa trên các selector CSS
$titleElements = $dom->getElementsByTagName('h1');
$descriptionElements = $dom->getElementsByTagName('p');
$imageElements = $dom->getElementsByTagName('img');


$data = [];
$count = 0;
foreach ($titleElements as $key => $element) {
    
    if ($element->parentNode->getAttribute('class')!='article-content') continue;
   
    $title = $element->textContent;
    $description = $element-> nextSibling->textContent;
    $image = $element->parentNode->previousSibling->childNodes[0]->childNodes[1]->getAttribute('data-src');
    $data[] = [
        'title' => $title,
        'description' => $description,
        'image' => $image
    ];
    $count++;
    
    if ($count >= 2) {
        break;
    }
   
}

// In kết quả
foreach ($data as $item) {
    echo "\n";
    echo "Title: " . $item['title'] . "<br>";
    echo "Description: " . $item['description'] . "<br>";
    echo "Image: " . $item['image'] . "<br>";
    echo "<hr>";
}