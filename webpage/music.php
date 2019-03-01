<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
 "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Music Viewer</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link href="viewer.css" type="text/css" rel="stylesheet" />
	</head>
	<body>
		<div id="header">

			<h1>190M Music Playlist Viewer</h1>
			<h2>Search Through Your Playlists and Music</h2>
		</div>
		<div id="listarea">
			<?php
				$parameter = isset($_REQUEST['playlist']) ? $_REQUEST['playlist']:null;
				$musicFiles = scandir("songs/");
				echo "<ul>";
				if($parameter != ''){
					$playlistFromFile = file("songs/".$parameter);
					foreach ($playlistFromFile as $i) {
						$i = trim($i);
						$fileSizeNumber = filesize("songs/".$i);
						if($fileSizeNumber >= 0 && $fileSizeNumber <= 1023){
							$fileSizeNumber = $fileSizeNumber.' b';
						}elseif ($fileSizeNumber > 1023 && $fileSizeNumber <= 1048575){
							$fileSizeNumber = round($fileSizeNumber/1024,2).' kb';
						}else{
							$fileSizeNumber = round($fileSizeNumber/1048576,2).' mb';
						}
						echo '<li class="mp3item"><a href="songs/'.$i.'">'.$i.' ('.$fileSizeNumber.')</a></li>';
					}
				}else{
					foreach ($musicFiles as $i) {
						$i = trim($i);
						$fileSizeNumber = filesize("songs/".$i);
						if($fileSizeNumber >= 0 && $fileSizeNumber <= 1023){
							$fileSizeNumber = $fileSizeNumber.' b';
						}elseif ($fileSizeNumber > 1023 && $fileSizeNumber <= 1048575){
							$fileSizeNumber = round($fileSizeNumber/1024,2).' kb';
						}else{
							$fileSizeNumber = round($fileSizeNumber/1048576,2).' mb';
						}
						if(strpos($i, ".mp3")){
							echo '<li class="mp3item"><a href="songs/'.$i.'">'.$i.' ('.$fileSizeNumber.')</a></li>';
						}
					}
					foreach ($musicFiles as $i) {
						if(strpos($i, ".txt")){
							echo '<li class="playlistitem"><a href="songs/'.$i.'">'.$i.'</a></li>';
						}
					}
				}
				echo "</ul>";
			?>
		</div>
	</body>
</html>