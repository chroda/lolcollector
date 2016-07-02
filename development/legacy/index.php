<?php
/**
 * @AUTHOR		Christian Marcell de Oliveira (chroda) <chroda@chroda.com.br>
 * @COPYRIGHT	Dev n' Quest 2014
 * @PACKAGE		DnQ LolC
 * @SINCE		July 2013
 * @VERSION		0.1
 *
 * ALERT: Don't change anything here, go to 'config.php' to set up your project.
 */

/**
 * Setting up and database connecting.
 */
require_once './config.php';

$_dir = '';
$_response = Array();

/**
 * Initializer.
 */
require_once __ROOT__.'init.php';

/**
 * Verifying the existence of the page.
 */
if(rewrite(1) == 'user'):
	/**
	 * Renders the user page.
	 */
	if(rewrite(2)==''||rewrite(2)=='login'){
		include_once(__VIEW_USER_PATH__.'login'.__VIEW_EXT__);
	}elseif(array_search(rewrite(2),$_SESSION['pages']['user'])){
		/**
		 * Renders page registered in admin key of the bootstrap file.
		 */
		require_once(__VIEW_PATH__.'components/header.php');
		require_once(__VIEW_USER_PATH__.rewrite(2).__VIEW_EXT__);
		require_once(__VIEW_PATH__.'components/footer.php');
	}else{
		$mysql->Select('user',array('username'=>rewrite(2)));
		if($mysql->iRecords == 1):
			/**
			 * Renders the profile page.
			*/
			require_once(__VIEW_PATH__.'components/header.php');
			include_once(__VIEW_PATH__.'user/profile'.__VIEW_EXT__);
			require_once(__VIEW_PATH__.'components/footer.php');
		else:
			$mysql->Select('user',array('username'=>strtolower(rewrite(2))));
			if($mysql->iRecords == 1){
				/**
				 * Redirect to right profile page.
				 */
				header('Location:'.location('user/'.strtolower(rewrite(2)),1));
			}else{
				/**
				 * Redirect to signup.
				 */
				header('Location:'.location('user/signup',1));
			}
		endif;
	}
elseif(rewrite(1)==''||rewrite(1)=='index'||rewrite(1)=='home'):
	/**
	 * Renders the home page.
	 */
	require_once(__VIEW_PATH__.'components/header.php');
	include_once(__VIEW_PATH__.'home'.__VIEW_EXT__);
	require_once(__VIEW_PATH__.'components/footer.php');
//elseif(array_search(end(@rewrite()),array('en'=>'en','es'=>'es','pt'=>'pt'))):
//	$_SESSION['user']['locale']=end(@rewrite());
//	header('Location:'.location(removeLastCharacter(rewrite(0),'',2),true));
elseif(array_search(rewrite(1),$_SESSION['pages'])):
	/**
	 * Renders page registered in the bootstrap file.
	 */
	require_once(__VIEW_PATH__.'components/header.php');
	include_once(__VIEW_PATH__.rewrite(1).__VIEW_EXT__);
	require_once(__VIEW_PATH__.'components/footer.php');
elseif(file_exists(__VIEW_PATH__.rewrite(1).__VIEW_EXT__)):
	/**
	 * Renders existing file (no header and no footer).
	 */
	include_once ( __VIEW_PATH__.rewrite(1).__VIEW_EXT__ );
else:
	/**
	 * Check for user profile.
	 */
	$mysql->Select('user',array('username'=>strtolower(rewrite(1))));
	if($mysql->iRecords == 1):
		header('Location:'.location('user/'.strtolower(rewrite(1)),true));
	else:
		/**
		 * Renders file of error 404.
		 */
		header("HTTP/1.0 404 Not Found");
		header("Status: 404 Not Found");
		require_once(__VIEW_PATH__.'components/header.php');
		include_once(__VIEW_PATH__.'components/error404.php');
		require_once(__VIEW_PATH__.'components/footer.php');
	endif;
endif;