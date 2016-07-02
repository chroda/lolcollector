<?php
function topChampionShuffle($indexArray=1,$jsDump=false){
	$path 			= __ROOT__ . 'cdn/img/nav-random/';
	if(!isset($_SESSION['graphics'])){
		if($handle 		= opendir($path)){
			while(false !== ($file = readdir($handle))){
				if($file != "." && $file != ".." && $file != ".svn"){
					$fileInfo = pathinfo($path.$file);
					if($fileInfo['extension'] == 'png' || $fileInfo['extension'] == 'jpg'){
						$_SESSION['graphics'][] = $file;
					}
				}
			}closedir($handle);
		}
	}
	shuffle($_SESSION['graphics']);
	if($jsDump == true){
		return $_SESSION['graphics'];
	}
	if(file_exists($path.$_SESSION['graphics'][$indexArray])){
		return $_SESSION['graphics'][$indexArray];
	}else{
		unset($_SESSION['graphics']);
		topChampionShuffle(2);	
	}
}

function adsence($adslot,$responsive=false,$height=200,$width=200){
	$display		= 'inline-block';
	$fomart 		= null;
	if($responsive == true){
		$display 	= 'block';
		$fomart 	= 'data-ad-format="auto"';
	}
	return '<ins	class="adsbygoogle" 
					style="	display	:'.$display.';
							width	:'.$width.'px;
							height	:'.$height.'px;" 
					data-ad-client	="'.__APP_ADSENCE__.'" 
					data-ad-slot	="'.$adslot.'" 
					'.$fomart.'>
			</ins><script>( adsbygoogle = window.adsbygoogle || []).push({});</script>';
}



?>