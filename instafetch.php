<?php
// Script by Jens Wittmann (www.jens-wittmann.de)

// max Photos
$max = 5;
// Tag
$tag = 'leokarneval';

$cachefile = $_SERVER['DOCUMENT_ROOT'].'assets/cache/instafetch.txt';
if (isset($cronjob)) {
	$url = 'http://instagram.com/tags/'.$tag.'/feed/recent.rss';
	$rss = simplexml_load_file($url);
	if ($rss) {
		$items = $rss->channel->item;
		$i = 0;
		$str = '';
		foreach($items as $item) {
			if ($i < $max) {
				$title = $item->title;
				$link = $item->link;
				$published_on = $item->pubDate;
				$description = $item->description;
				$media = array();
				foreach ($item->getNameSpaces(true) as $key => $children) {
					$$key = $item->children( $children );
				}				
				$str .= '<div class="container"><img src="'.$link.'" alt="'.$title.'"><p><strong>'.$media->credit.':</strong> '.$title.'</p></div>';
			}
			$i++;
		}
		if (count($str) > 0) {		
			$file = fopen($cachefile, 'w');
			fwrite($file, $str);
			fclose($file);
			echo 'Instagram Cache aktualisiert.';
		} else {
			echo 'RSS Feed zu kurz.';
		}
	} else {
		echo 'Konnte RSS Feed nicht laden!';
	}
} elseif (file_exists($cachefile) && filesize($cachefile) > 0) {
	$file = fopen($cachefile, 'r');
	$str = fread($file, filesize($cachefile));
	fclose($file);
	echo $str;
} else {
	echo 'Instagram is down.';
}
?>