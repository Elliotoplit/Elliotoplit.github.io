<?php
header('Content-Type:text/html;charset=utf-8');
$xmldata =file_get_contents("你的sitemap.xml链接");
$xmlstring = simplexml_load_string($xmldata,'SimpleXMLElement',LIBXML_NOCDATA);
$value_array = json_decode(json_encode($xmlstring),true);
$url = [];
for ($i =0;$i < count($value_array['url']);$i++){
    echo $value_array['url'][$i]['loc']."<br/>";
    $url[]= $value_array['url'][$i]['loc'];
}
$api ='http://data.zz.baidu.com/urls?site=https://elliotoplit.github.io&token=Prej2VpZzMioaTud';
$ch = curl_init();
$options = array(
   CURLOPT_URL => $api,
   CURLOPT_POST => true,
   CURLOPT_RETURNTRANSFER => true,
   CURLOPT_POSTFIELDS => implode("\n",$url),
   CURLOPT_HTTPHEADER => array('Content-Type:text/plain'),
);
curl_setopt_array($ch, $options);
$result =curl_exec($ch);
echo $result;
?>