<fieldset>
	<legend>
    <?php echo $_SESSION['seo']['page'];?>
  </legend>
</fieldset>

<table class="table table-striped table-hover table-responsive">
	<thead>
		<tr>
			<th class="text-center"	>#</th>
			<th class="text-center"	>Ícone</th>
			<th class="text-left"		>Nome</th>
			<th class="text-right"	>Campeões Colecionados</th>
			<th class="text-right"	>Skin Colecionadas</th>
			<th class="text-center"	>Servidor</th>
			<th class="text-center"	>Gênero</th>
		</tr>
	</thead>
	<tbody>
		<?php
    $c = 0;
    foreach($summoners as $nr => $summoner):
			$collectionChampions=count($summoner->champions);
			$collectionSkins=count($summoner->champions_skins);
      ?>
			<tr>
				<td class="text-center">
          <a href="<?php location($summoner->username);?>">
            <?php echo ++$c;?>
          </a>
        </td>
				<td class="text-center"	>
          <a href="<?php location($summoner->username);?>">
            <img height="20" width="20" src="http://avatar.leagueoflegends.com/<?php echo $summoner->server;?>/<?php echo $summoner->username;?>.png"/>
          </a>
        </td>
				<td class="text-left"	>
          <a href="<?php location($summoner->username);?>">
            <?php echo $summoner->name;?>
          </a>
        </td>
				<td class="text-right"	>
          <a href="<?php location($summoner->username);?>">
            <?php echo $collectionChampions;?>
          </a>
        </td>
				<td class="text-right"	>
          <a href="<?php location($summoner->username);?>">
            <?php echo $collectionSkins;?>
          </a>
        </td>
				<td class="text-center"	>
          <a href="<?php location($summoner->username);?>" class="">
            <?php echo $summoner->serverFullname;?>
          </a>
        </td>
				<td class="text-center"	>
          <a href="<?php location($summoner->username);?>" class="btn btn-default btn-xs btn-<?php echo $summoner->sex == '1' ? 'primary':'info';?>" role="button">
            <i class="fa fa-user"></i>
          </a>
        </td>
			</tr>
		<?php endforeach;
    ?>
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
