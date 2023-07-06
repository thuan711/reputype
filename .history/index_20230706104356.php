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

// Lặp qua từng phần tử và lấy thông tin cần thiết
$data = [];
foreach ($titleElements as $key => $element) {
    if ($key >= 1 && $key <= 2) {
        $title = $element->textContent;
        $description = isset($descriptionElements[$key]) ? $descriptionElements[$key]->textContent : '';
        $image = isset($imageElements[$key]) ? $imageElements[$key]->getAttribute('src') : '';
        $link = $element->getElementsByTagName('a')->item(0)->getAttribute('href');
        
        $data[] = [
            'title' => $title,
            'description' => $description,
            'image' => $image,
            'link' => $link,
        ];
    }
}

// In kết quả
foreach ($data as $item) {
    echo "\n";
    echo "Title: " . $item['title'] . PHP_EOL;
    echo "Description: " . $item['description'] . PHP_EOL;
    echo "Image: " . $item['image'] . PHP_EOL;
    echo "Link: " . $item['link'] . PHP_EOL;
    echo PHP_EOL;
}
