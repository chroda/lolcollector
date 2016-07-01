<?php

function pr($expression=false,$dump=false){
	print'<pre style="z-index:9999;block;position:relative;">';
	$dump===true?var_dump($expression):print_r($expression);
	print'</pre>';
}
