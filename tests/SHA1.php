<?php
	header("Content-Type: application/xml");
	ini_set('max_execution_time', 300);
	require "../lib/AlphaKey.php";
	$hash = "e7bd830ae2d0c840ab7cd2131cd33ff38c069cbe";
	$myAlphaKey = new AlphaKey();
	$result = $myAlphaKey->testAgainst(create_function('$guess','return sha1($guess);'),$hash);
	$match_found = ($result !== INF);
	echo '<?xml version="1.0" encoding="UTF-8"?>'."\n";
?>
<AlphaKey>
	<test>
		<function>SHA1</function>
		<target><?php echo $hash; ?></target>
		<match_found><?php echo $match_found; ?></match_found>
		<?php
			if ($match_found) {
				echo '<match>'.$result.'</match>';
			}
		?>
	</test>
</AlphaKey>
