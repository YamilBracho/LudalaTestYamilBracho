<?php
$urlArray = array( 'tech_news' => 'http://news.yahoo.com/rss/tech',
                   'entertaiment' => 'http://news.yahoo.com/rss/entertainment',
				   'news' => 'http://news.yahoo.com/rss/sports');
$rss = $_GET['rss'];
if (!array_key_exists($rss, $urlArray)) {
	$response = array('Result' => 'ERROR', 'Message' => "$rss not found!") ;
} else { 
	$url = $urlArray[$rss];
	$rss = simplexml_load_file($url);
	$data = array();
	foreach ($rss->channel->item as $item) {
		$data [] = array( 'title' => (string )$item->title, 
						  'link' =>  (string) $item->link );
	} 	
	$response = array('Result' => 'OK', 'Info' => $data) ;
}
echo json_encode($response);
?>
