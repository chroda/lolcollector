(function($){
	$(function(){
		var userId 				= $('span#userId'					).text();
		var CollectionChampions = parseInt($('#collectionChampion'	).text());
		var CollectionSkins 	= parseInt($('#collectionSkin'		).text());
		var Champions 			= parseInt($('#champions'			).text());
		var Skins	 			= parseInt($('#skins'				).text());
		var btnOwnedAll			= 'Eu tenho todos!';
		var btnOwnedNothing		= 'Eu não tenho todos.';
		function countingChampions(){
			if(CollectionChampions == Champions){
				$('#selectAll').text(btnOwnedNothing);
			}else if(CollectionChampions == 0){
				$('#selectAll').text(btnOwnedAll);
			}else{
				$('#selectAll').text(btnOwnedAll);
			}
		}countingChampions();
		$('#selectAll').click(function(){
			if($.trim($(this).text()) === btnOwnedAll){
				$.ajax({
					url: "ajax?action=own-all-champions",
					type: "POST",
					data:{user_id:userId},
					dataType: "json",
				});
				CollectionChampions = Champions;
				$('#championsList li img').addClass('owned');
			}else{
				$.ajax({
					url: "ajax?action=not-own-all-champions",
					type: "POST",
					data:{user_id:userId},
					dataType: "json",
				});
				
				cl(CollectionChampions);
				CollectionChampions	= 0;
				$('#collectionSkin').text(0);
				$('#championsList li img').removeClass('owned');
			}
			$('#collectionChampion').text(CollectionChampions);
			countingChampions();
		});
		$('#championsList li img').click(function(){
			if($(this).hasClass('owned')){
				$.ajax({
					url: "ajax?action=not-own-champion",
					type: "POST",
					data:{user_id:userId,champion_id:$(this).attr('alt')},
					dataType: "json"
				}).done(function(data){CollectionSkins=data.countingSkins;});
				$(this).removeClass('owned');
				$('#collectionChampion').text(--CollectionChampions);
				
			}else{
				$.ajax({
					url: "ajax?action=own-champion",
					type: "POST",
					data:{user_id:userId,champion_id:$(this).attr('alt')},
					dataType: "json",
				});
				$(this).addClass('owned');
				$('#collectionChampion').text(++CollectionChampions);
			}
			countingChampions();
		});
		
		$('#championsSkinsList li img').click(function(){
			var alt = $(this).attr('alt').split('_');
			if($(this).hasClass('owned')){
				$.ajax({
					url: "ajax?action=not-own-skinchampion",
					type: "POST",
					data:{user_id:userId,champion_id:alt[0],number:alt[1]},
					dataType: "json",
				});
				$(this).removeClass('owned');
				$('#collectionSkin').text(--CollectionSkins);
			}else{
				$.ajax({
					url: "ajax?action=own-skinchampion",
					type: "POST",
					data:{user_id:userId,champion_id:alt[0],number:alt[1]},
					dataType: "json",
				});
				$(this).addClass('owned');
				$('#collectionSkin').text(++CollectionSkins);
			}
		});
		
	});
})(jQuery);