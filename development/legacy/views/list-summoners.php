<fieldset>
	<legend><?php echo $_SESSION['seo']['page'];?></legend>
</fieldset>

<table class="table table-striped table-hover table-responsive">
	<thead>
		<tr>
			<th class="text-center"	>#</th>
			<th class="text-center"	>Ícone</th>
			<th class="text-left"	>Nome</th>
			<th class="text-right"	>Campeões Colecionados</th>
			<th class="text-right"	>Skin Colecionadas</th>
			<th class="text-center"	>Servidor</th>
			<th class="text-center"	>Gênero</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($summoners as $nr=>$summoner):
			$mysql->Select('user_champion',array('user_id'=>$summoner['id']));
			$collectionChampions=$mysql->iRecords;
			$mysql->Select('user_skinchampion',array('user_id'=>$summoner['id']));
			$collectionSkins=$mysql->iRecords;
			$nr++;
		?>
			<tr>
				<td class="text-center"	><a href="<?php location($summoner['username']);?>"><?php echo $nr;?></a></td>
				<td class="text-center"	><a href="<?php location($summoner['username']);?>"><img height="20" width="20" src="http://avatar.leagueoflegends.com/<?php echo $summoner['server'];?>/<?php echo $summoner['username'];?>.png"/></a></td>
				<td class="text-left"	><a href="<?php location($summoner['username']);?>"><?php echo $summoner['name'];?></a></td>
				<td class="text-right"	><a href="<?php location($summoner['username']);?>"><?php echo $collectionChampions;?></a></td>
				<td class="text-right"	><a href="<?php location($summoner['username']);?>"><?php echo $collectionSkins;?></a></td>
				<td class="text-center"	><a href="<?php location($summoner['username']);?>" class=""><?php echo $summoner['server']=='br'?'Brasil':null;?></a></td>
				<td class="text-center"	><a href="<?php location($summoner['username']);?>" class="btn btn-default btn-xs btn-<?php echo $summoner['sex']=='1'?'primary':'info';?>" role="button"><i class="fa fa-user"></i></a></td>
			</tr>
		<?php endforeach;?>
	</tbody>
	<tfoot>
		<tr>
			<th class="text-center"	>#</th>
			<th class="text-center"	>Ícone</th>
			<th class="text-left"	>Nome</th>
			<th class="text-right"	>Campeões Colecionados</th>
			<th class="text-right"	>Skin Colecionadas</th>
			<th class="text-center"	>Servidor</th>
			<th class="text-center"	>Gênero</th>
		</tr>
	</tfoot>
</table>