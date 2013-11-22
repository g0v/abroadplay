<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
範例

這裡有幾個路由的範例：

$route['journals'] = "blogs";
一個在第一片段包含"journals"這個字的URL，將被重新對應到"blogs"類別。

$route['blog/joe'] = "blogs/users/34";
一個包含"blog/joe"片段的URL，將重新對應到"blogs"類別以及"users"方法。ID將會設定成"34"。

$route['product/(:any)'] = "catalog/product_lookup";
一個在第一片段是"product"而在第二片段是任何值的URL，將重新對應到"catalog"類別以及"product_lookup"方法。

$route['product/(:num)'] = "catalog/product_lookup_by_id/$1";
一個在第一片段為"product"而第二片段是任何數字的URL將重新對應到"catalog"類別以及"product_lookup_by_id"方法，匹配的數字將傳給這個函數作為變數。

非常重要：不要在開頭/結尾使用斜線。
正規式

如果你偏好使用正規式來定義路由規則，任何合法的正規式都允許使用，包括back reference。

注意：如果使用back reference，你必須使用$語法而不是\\語法。
一個典型的正規式路由可能看起來像這樣：

$route['products/([a-z]+)/(\d+)'] = "$1/id_$2";
在上例中，一個像products/shirts/123的URL會轉而呼叫shirts控制器(controller)類別及id_123函數。

你也可以混合且用萬用字元來與正規式匹配。
*/

//$route['([a-z]+)/([a-z]+)/(:any)'] = '$1/$2/$3';
$route['default_controller'] = "home";
$route['404_override'] = 'errors/page_missing';

/* End of file routes.php */
/* Location: ./application/config/routes.php */