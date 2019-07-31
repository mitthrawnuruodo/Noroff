<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-10175057-1"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());
		  gtag('config', 'UA-10175057-1');
		</script>
		<title>Timeline of computers and the Internet</title>
		<meta name="description" content="An extensive timeline with the key elements in the development of computers and the internet with data mostly from Wikipedia.">
		<meta name="author" content="Lasse Hægland">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="mystyle.css">
	</head>
	<body>
		
		<h1>Timeline of computers and the Internet</h1>
		<p>Dynamic data from <a href="http://www.geek.no/noroff/timeline/trivia-data.json">trivia-data.json</a>.</p> 

		<div class="timeline">			
<?php
	//$here = '/Users/noro-lha/Documents/Noroff-til-geek/timeline'; // Change to something better online
	$file = 'https://www.geek.no/noroff/timeline/'.'trivia-data.json';
	$file_content = file_get_contents($file);
	$json = json_decode($file_content, true);
	//var_dump($json);
?>
<?php foreach ($json['trivia'] as $trivia) { ?>

			<div class="container">
				<div class="content">
					<h2><?=$trivia['date']?></h2>
					<p><?=$trivia['detail']?></p>
<?php 	if ($trivia['img-src']!=null) { ?>
					<img src="images/<?=$trivia['img-src']?>" alt="<?=$trivia['mg-alt']?>">
<?php 	} ?>
				</div>
			</div>
<?php } ?>			
		</div><!-- / Timeline -->

		<hr>
		<p>Sources: Mostly <a href="https://wikipedia.org" target="_blank">Wikipedia</a>. All dates (from 1583 and onwards) are according to <a href="https://xkcd.com/1179/" target="_blank">ISO 8601</a>. <span id="lastedited" style="white-space: nowrap;"><?php 
			
	$timestamp = filemtime('./trivia-data.json');
	$date = date('Y-m-d H:i:s', $timestamp);
	echo "Data last edited: " . $date;	
	
	$timestamp = filemtime(__FILE__);
	$date = date('Y-m-d H:i:s', $timestamp);
	echo " - File last edited: " . $date;

?></span> <a href="https://www.geek.no/">Back to Geek.no</a>. </p>
<!--
		<script>
			var edited = new Date(document.lastModified);
			//var norskdato = edited.toLocaleDateString("nb-no");
			var year = edited.getFullYear();
			var month = edited.getMonth() + 1;
			if (month < 10) { month = "0" + month; }
			var date = edited.getDate();
			if (date < 10) { date = "0" + date; }
			var hrs = edited.getHours();
			if (hrs < 10) { hrs = "0" + hrs; }
			var min = edited.getMinutes();
			if (min < 10) { min = "0" + min; }
			document.getElementById("lastedited").innerHTML = "Last edited: " + year + "-" + month + "-" + date + " " + hrs + ":" + min + ".";
		</script>
-->
	</body>
</html>