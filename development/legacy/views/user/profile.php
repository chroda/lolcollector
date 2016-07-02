<?php
	$mysql->Select('champion'			,array(),'name');					$champions 													= $mysql->aArrayedResults;
	$mysql->Select('skinchampion'		,array(),'name');					$skins 														= $mysql->aArrayedResults;
	$mysql->Select('user'				,array('username'=>rewrite(2)));	$profile 													= $mysql->aArrayedResults[0];
	$mysql->Select('user_champion'		,array('user_id'=>$profile['id']));	$collectionChampions										= $mysql->iRecords;
	if($mysql->iAffected>0){foreach($mysql->aArrayedResults as $championColected){$championsColected[$championColected['champion_id']]	= $championColected;}}
	$mysql->Select('user_skinchampion'	,array('user_id'=>$profile['id']));	$collectionChampionsSkins									= $mysql->iRecords;
	if(rewrite(3)==''){echo '<META http-equiv="refresh" content="0;URL='.location('user/'.$profile['username'].'/champions/',true).'"/>';}
?>
<div class="panel panel-<?php echo $profile['sex']=='1'?'primary':'info';?>">
	<div class="panel-heading">
		<div class="col-lg-2">
			<img class="img-thumbnail" src="http://avatar.leagueoflegends.com/br/<?php echo rewrite(2);?>.png"/>
		</div>
		<div class="col-lg-10">
			<br clear="all"/>
			<h3 class="panel-title">
				Coleção d<?php echo $profile['sex']=='1'?'o':'a';?> Invocador<?php echo $profile['sex']=='1'?'':'a';?> <strong><?php echo $profile['name'];?></strong> :
				<div class="pull-right">
					<div class="fb-share-button" data-href="<?php location('user/'.rewrite(2).'/'.rewrite(3));?>" data-type="button"></div> 
				</div>
			</h3>
			<br clear="all"/>
			<br clear="all"/>
			<ul class="nav nav-pills nav-justified">
				<li class="<?php echo rewrite(3)=='champions'	?'active':null;?>"><a href="<?php location('user/'.$profile['username'].'/champions	');?>">Campeões</a></li>
				<li class="<?php echo rewrite(3)=='skins'		?'active':null;?>"><a href="<?php location('user/'.$profile['username'].'/skins		');?>">Skins</a></li>
				<li class="<?php echo rewrite(3)=='stats'		?'active':null;?>"><a href="<?php location('user/'.$profile['username'].'/stats		');?>">Stats</a></li>
			</ul>
		</div>
		<br clear="all"/>
	</div>
	<div class="panel-body">
		<span id="userId"><?php echo $profile['id'];?></span>
		<span id="numberOwned">
			<h5>
				Este invocador tem na sua coleção 
				<span id="collectionChampion" 	class="badge btn-<?php echo $profile['sex']=='1'?'primary':'info';?>"><?php echo $collectionChampions;?></span>
				de
				<span id="champions" 	class="badge btn-lolc"><?php echo count($champions);?></span>
				campeões.
				
				E possui
				<span id="collectionSkin" 	class="badge btn-<?php echo $profile['sex']=='1'?'primary':'info';?>"><?php echo $collectionChampionsSkins;?></span>
				de
				<span id="skins" 		class="badge btn-lolc"><?php echo count($skins);?></span>
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
				<?php if($user->isLoggedIn() === true && rewrite(2)==$user->getUsername()):?>
					<button id="selectAll" class="btn btn-lolc btn-block"></button>
					<hr/>
				<?php endif;?>
				<ul id="championsList">
					<?php foreach($champions as $champion):?>
						<?php $class='';$mysql->Select('user_champion',array('user_id'=>$profile['id'],'champion_id'=>$champion['id']));if($mysql->iRecords){$class = 'class="owned"';}?>
						<li>
							<img src="<?php echo CDN_DIR.'img/champions/'.ucfirst(str_replace(' ','',str_replace('.','',str_replace('-','',str_replace('\'','',$champion['name']))))).'_Square_0.png';?>" alt="<?php echo $champion['id'];?>" <?php echo $class;?> data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $champion['name'];?>"/>		
						</li>
					<?php endforeach;?>
				</ul>
				<?php break;
			case 'skins':?>
				<ul id="championsSkinsList">
					<?php foreach($champions as $champion){?>
						<?php if(!isset($championsColected[$champion['id']])){continue;}
						$mysql->Select('skinchampion',array('riot_id'=>$champion['riot_id']));
						$skins = $mysql->aArrayedResults;?>
						<h3><?php echo $champion['name'];?></h3>
						<?php foreach($skins as $skin):?>
							<?php $class='';$mysql->Select('user_skinchampion',array('user_id'=>$profile['id'],'champion_id'=>$skin['champion_id'],'number'=>$skin['number']));if($mysql->iRecords){$class = 'class="owned"';}?>
							<li>
								<img src="<?php echo CDN_DIR.'img/skins/champion/'.$champion['riot_key'].'_'.$skin['number'].'.jpg';?>" alt="<?php echo $skin['champion_id'].'_'.$skin['number'];?>" <?php echo $class;?> data-toggle="tooltip" data-placement="top" title="<?php echo utf8_decode($skin['name']);?>" data-original-title="<?php echo utf8_decode($skin['name']);?>"/>		
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

						<?php 
							//pr($profile);
						?>
					</h2>
				</div>
				<?php break;
		endswitch;?> 
	</div>
	<!-- <div class="panel-footer"></div> -->
</div>