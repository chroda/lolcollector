/**
 * @AUTHOR		Christian Marcell de Oliveira	(chroda) <chroda@chroda.com.br>
 * @AUTHOR		Walter Luiz Martins				(urtred) <walter.martins@hotmail.com.br>
 * @COPYRIGHT	Dev n' Quest 2014
 * @PACKAGE		DnQ Ignite
 * @SINCE		February 2014
 * @VERSION		0.1
 *
 * Functions for javascript uses;
 */
function cl(param){if(window.console && window.console.log){console.log(param);}}
function preload(arrayOfImages){$(arrayOfImages).each(function(){$('<img/>')[0].src = this;});}
function getRandomArbitary(min,max){return Math.random()*(max-min)+min;}
function getRandomInt(min,max){return Math.floor(Math.random()*(max-min+1))+min;}
function changeBG(delay){
	var nmbGen=getRandomInt(1,5);
	var urlImg="url('"+$.App.url+"cdn/img/bkg/"+nmbGen+".jpg')";
	$('#bkg').fadeOut(delay,function(){$('#bkg').css({'backgroundImage':urlImg});});
	$('#bkg').fadeIn(delay);
}
function modalLoader(display) {
	jQuery('.modalLoader').remove();
	if (display == true) {
		jQuery('body').append('<div class="modalLoader" style="position:fixed;top:0;left:0;z-index:9999;width:100%;height:100%;background-color: rgba(50,50,50,0.9);"><p id="modalLoaderLabel" style="position:absolute; font-weight: bold !important; color: #16959F !important; text-align: center !important; width: 100% !important; top: 50% !important;margin-top:-100px;"><img src="./cdn/img/ico-200.png"/></p></div>');
	}
}
function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
    return pattern.test(emailAddress);
};