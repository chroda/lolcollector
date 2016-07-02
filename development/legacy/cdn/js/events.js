/**
 * @AUTHOR		Christian Marcell de Oliveira	(chroda) <chroda@chroda.com.br>
 * @AUTHOR		Walter Luiz Martins				(urtred) <walter.martins@hotmail.com.br>
 * @COPYRIGHT	Dev n' Quest 2014
 * @PACKAGE		DnQ Ignite
 * @SINCE		February 2014
 * @VERSION		0.1
 *
 * Events on webservice;
 */
(function($){

	$(document).ready(function(){
		modalLoader(true);	
		preload($.App.graphics);
	});
	$(window).ready(function(){
		modalLoader();	
		$('img').load(function(){
			modalLoader(true);	
		});
		$('img').load(function(){
			modalLoader();	
		});
		
		$('#championsList li img').tooltip();
	});
})(jQuery);