<?php

	$versions = json_decode(file_get_contents('https://global.api.riotgames.com/api/lol/static-data/BR/v1.2/versions?api_key='.__APP_RIOTAPI_KEY__));
	$portraitUrl = 'http://ddragon.leagueoflegends.com/cdn/'.$versions[0].'/img/champion/championKey.png';
	$skinloadingUrl = 'http://ddragon.leagueoflegends.com/cdn/img/champion/loading/championKey_0.jpg';

	foreach($db->users as $profileId => $profileUser) {
		if($profileUser->username === rewrite(2)){
			$profile = $db->users[$profileId];
		}
	}

	$profileColor = ($profile->sex === 1) ? 'primary':'info';
	$profileTextGender = ($profile->sex === 1) ? 'do Invocador':'da Invocadora';

	$collectionChampions = count(User::getChampions($profile->id));
	$collectionChampionsSkins = count(User::getChampionsSkins($profile->id));

	if(rewrite(3)==''){
    echo '<META http-equiv="refresh" content="0;URL='.location('user/'.$profile->username.'/champions/',true).'"/>';
  }
?>
<div class="panel panel-<?php echo $profileColor;?>">
	<div class="panel-heading">
		<div class="col-lg-2">
			<img class="img-thumbnail" src="http://avatar.leagueoflegends.com/br/<?php echo rewrite(2);?>.png"/>
		</div>
		<div class="col-lg-10">
			<br clear="all"/>
			<h3 class="panel-title">
				Coleção <?php echo $profileTextGender;?>
				<strong><?php echo $profile->name;?></strong> :
				<div class="pull-right">
					<div class="fb-share-button" data-href="<?php location('user/'.rewrite(2).'/'.rewrite(3));?>" data-type="button"></div>
				</div>
			</h3>
			<br clear="all"/>
			<ul class="nav nav-pills nav-justified">
				<li class="<?php echo rewrite(3) === 'champions' ? 'active' : null;?>">
					<a href="<?php location('user/'.$profile->username.'/champions');?>">Campeões</a>
				</li>
				<li class="<?php echo rewrite(3) === 'skins' ? 'active' : null;?>">
					<a href="<?php location('user/'.$profile->username.'/skins');?>">Skins</a>
				</li>
				<li class="<?php echo rewrite(3) === 'stats' ? 'active' : null;?>">
					<a href="<?php location('user/'.$profile->username.'/stats');?>">Stats</a>
				</li>
			</ul>
		</div>
		<br clear="all"/>
	</div>
	<div class="panel-body">
		<span id="userId"><?php echo $profile->id;?></span>
		<span id="numberOwned">
			<h5>
				Este invocador tem na sua coleção
				<span id="collectionChampion" class="badge btn-<?php echo $profileColor;?>"><?php echo $collectionChampions;?></span>
				de
				<span id="champions" class="badge btn-lolc"><?php echo count($champions);?></span>
				campeões.

				E possui
				<span id="collectionSkin" class="badge btn-<?php echo $profileColor;?>"><?php echo $collectionChampionsSkins;?></span>
				de
				<span id="skins" class="badge btn-lolc"><?php echo count($skins);?></span>
				skins.
			</h5>
		</span>
		<hr/>
		<div class="well-sm well">
			<div class="fb-like" data-href="<?php location('user/'.rewrite(2));?>" data-width="943" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
		</div>
		<hr/>
		<?php switch(rewrite(3)):
			case 'champions':?>
				<?php if( ($user->isLoggedIn() === true) && (rewrite(2) === $user->getUsername()) ):?>
					<button id="selectAll" class="btn btn-lolc btn-block"></button>
					<hr/>
				<?php endif;?>
				<ul id="championsList">
					<?php foreach($champions as $championName => $champion):
						$owned = $user->haveChampion($champion->id) ? 'owned' : null; ?>
						<li style="margin:10px">
							<img
								src="<?php echo str_replace('championKey',$champion->key,$portraitUrl);?>"
								alt="<?php echo $champion->id;?>"
								class="<?php echo $owned;?>"
								data-toggle="tooltip"
								data-placement="top"
								title="<?php echo $champion->name;?>"
								data-original-title="<?php echo $champion->name;?>
							"/>
						</li>
					<?php endforeach;?>
				</ul>
				<?php break;

			case 'skins':?>
				<ul id="championsSkinsList">
					<?php foreach($champions as $champion){
						if(!$user->haveChampion($champion->id)){
							continue;
						}?>
						<h3><?php echo $champion->name;?></h3>
						<?php foreach($champion->skins as $skin):
							if($skin->num === 0){
								continue;
							}
							$skin_key = $champion->key.'_'.$skin->num;

							// SKTT1 STILL NOT READY
							if($skin_key === 'Alistar_9'){continue;}
							if($skin_key === 'Elise_4'){continue;}
							if($skin_key === 'Renekton_8'){continue;}
							if($skin_key === 'Ryze_10'){continue;}
							if($skin_key === 'Sivir_9'){continue;}

							$owned = $user->haveChampionSkin($skin->id) ? 'owned' : null; ?>
							<li style="margin:10px">
								<img
									src="<?php echo str_replace('championKey_0',$skin_key,$skinloadingUrl);?>"
									alt="<?php echo $skin->id;?>"
									class="<?php echo $owned;?>"
									data-toggle="tooltip"
									data-placement="top"
									title="<?php echo ($skin->name);?>"
									data-original-title="<?php echo ($skin->name);?>
								"/>
							</li>
						<?php endforeach;?>
						<br clear="all">
						<hr/>
					<?php }?>
				</ul>
				<?php break;
			case 'stats':?>
				<div class="jumbotron">
					<h2>
						Em Breve uma sessão de estatísticas sobre o invocador.
						(mentira, não tem!)
					</h2>
				</div>
				<?php break;
		endswitch;?>
	</div>
</div>
