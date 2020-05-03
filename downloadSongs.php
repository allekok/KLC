<?php
$output = "audio";
function download ($url, $timeout=1, $times=-1) {
	while(!($res = file_get_contents($url)) &&
	      $times-- !== 0) sleep($timeout);
	return trim($res);
}
$json = json_decode(file_get_contents(
	"KurdishLyricsCorpus.json"), TRUE);
$list = $json["lyrics"];
mdir($output, 0755, TRUE);
for($i = 0; $i < count($list); $i++) {
	$item = $list[$i];
	$audio = $item["div"]["audio"];
	if(!$audio) continue;

	$id = $item["@id"];
	echo "i:$i\tid:$id\t";
	file_put_contents("$output/$id.mp3", download($audio));
	echo "Downloaded\n";
}
?>
