<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$config['per_page'] = 50; 
//下面是分頁參數列表，您可以依照個人喜好設定參數，並且設定您喜歡的顯示效果。
//$config['uri_segment'] = 1;
//分頁函數會自動偵測決定您的 URI 哪個部份包含了頁數，如果你想指定不一樣的，你可以在這裡明確設定它。
$config['num_links'] = 4;
//放在您目前所在頁數前面跟後面所顯示的分頁數量。舉例來說，參數設定2，就會在前面跟後面兩邊多加兩個頁數，如同此頁最頂端的例子所顯示
$config['use_page_numbers'] = TRUE;
//預設會在 URI 顯示你要分頁項目的索引編號，而不是頁數。如果你比較喜歡使用頁數，將這個值設定為 TRUE 。
$config['page_query_string'] = FALSE;
//請注意 "per_page" 是預設的分頁變數字串，然而您可以利用設定
$config['query_string_segment'] = 'page';
//來改變您要的變數字串。
/*
    <div class="pagination quotes">
    <ul>
    <li class="disabled">第一頁</li>
    <li class="disabled">上一頁</li>
    <li class="current">1</li>
    <li><a href="?page=2">2</a></li>
    <li><a href="?page=3">3</a></li>
    <li><a href="?page=4">4</a></li>
    <li><a href="?page=5">5</a></li>
    <li><a href="?page=2">下一頁</a></li>
    <li><a href="?page=5">最後一頁</a></li>
    </ul>
    </div>
*/

//增加 Tag 標籤
//如果您希望在分頁左右兩邊加上 Tag 標籤，您可以利用下面兩種參數設定。

$config['full_tag_open'] = '<div class="pagination quotes">';
//此標籤是放在顯示分頁結果的左側。

$config['full_tag_close'] = '</div>';
//此標籤是放在顯示分頁結果的右側。

//自訂起始分頁連結名稱

$config['first_link'] = '第一頁';
//您希望在分頁左邊顯示"第一頁"的名稱。如果你不想讓連結呈現，你可以將值設為 FALSE

$config['first_tag_open'] = '<li>';
//第一頁連結左邊標籤。

$config['first_tag_close'] = '</li>';
//第一頁連結右邊標籤。

//自訂結束分頁連結名稱

$config['last_link'] = '最後一頁';
//您希望在分頁右邊顯示"最後一頁"的名稱。如果你不想讓連結呈現，你可以將值設為 FALSE

$config['last_tag_open'] = '<li>';
//最後一頁連結左邊標籤。

$config['last_tag_close'] = '</li>';
//最後一頁連結右邊標籤。

//自訂"下一頁"連結名稱

$config['next_link'] = '下一頁&gt;';
//您希望在分頁中顯示"下一頁"的名稱。如果你不想讓連結呈現，你可以將值設為 FALSE

$config['next_tag_open'] = '<li>';
//下一頁連結左邊標籤。

$config['next_tag_close'] = '</li>';
//下一頁連結右邊標籤。

//自訂"上一頁"連結名稱

$config['prev_link'] = '&lt;上一頁';
//您希望在分頁中顯示"上一頁"的名稱。如果你不想讓連結呈現，你可以將值設為 FALSE

$config['prev_tag_open'] = '<li>';
//上一頁連結的左邊標籤。

$config['prev_tag_close'] = '</li>';
//上一頁連結的右邊標籤。

//自訂"目前頁面"連結名稱

$config['cur_tag_open'] = '<li class="current">';
//目前頁面左邊標籤。

$config['cur_tag_close'] = '</li>';
//目前頁面右邊標籤。

//自訂分頁數字連結

$config['num_tag_open'] = '<li>';
//分頁數字連結左邊標籤。

$config['num_tag_close'] = '</li>';
//分頁數字連結右邊標籤。

//隱藏頁數
//如果你不想顯示頁數，例如你只想顯示上一頁與下一頁，你可以加入:
//$config['display_pages'] = FALSE;

//加入 class 屬性
//如果你想要為每個分頁類別的連結加入 class，你可以設定 "anchor_class" 為你要的 class


?>