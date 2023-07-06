<?php
include './simple_html_dom.php';
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
$url = 'https://dantri.com.vn/giao-duc-huong-nghiep/vu-lo-de-thi-sinh-8-thi-sinh-duoc-mom-de-can-xu-ly-the-nao-20230620004656478.htm';

// Tạo đối tượng Simple HTML DOM từ URL
$html = file_get_html($url);
// Lấy các phần tử trong trang web dựa trên các selector CSS
$titleElements = $dom->getElementsByTagName('h3');
$descriptionElements = $dom->getElementsByTagName('p');
$imageElements = $dom->getElementsByTagName('img');


$articleItemElements = $html->find('.article-item');
$data = [];

foreach ($articleItemElements as $articleItemElement) {
    $titleElement = $articleItemElement->find('.article-title', 0);
    $descriptionElement = $articleItemElement->find('.article-description', 0);

    if ($titleElement && $descriptionElement) {
        $title = $titleElement->plaintext;
        $description = $descriptionElement->plaintext;
        
        $data[] = [
            'title' => $title,
            'description' => $description
        ];

        // Đã lấy đủ số thông tin, thoát khỏi vòng lặp
        if (count($data) >= 2) {
            break;
        }
    }
}

// In kết quả
foreach ($data as $item) {
    echo "Tiêu đề: " . $item['title'] . "<br>";
    echo "Mô tả: " . $item['description'] . "<br>";
    echo "<br>";
}

