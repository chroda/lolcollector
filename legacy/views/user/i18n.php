<?php
  if((rewrite(3))){
    $mysql->Select('i18n', array('key' => rewrite(3)));
    if($mysql->iRecords == 1){$data = $mysql->aArrayedResults[0];
      if(rewrite(4)=='edit'){
        if($_POST){
          extract($_POST);
          if(!isset($key) || empty($key)){?>
            <div class="alert alert-error">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong><?php echo __t('error');?></strong> &mdash; <?php echo __t('error_message.2');?> &raquo; <?php echo __t('key');?>
            </div>
          <?}else{
            $data = array(
              'group'     => $group,
              'key'       => str_replace(' ','_',strtolower(trim($key))),
              'value_pt'  => $value_pt,
              'value_es'  => $value_es,
              'value_en'  => $value_en,
              'createdBy' => $_SESSION['user']['authenticated']['id'],
            );
            $mysql->Select('i18n', array('key' => $data['key']));
            if($mysql->iRecords == 0){
              $mysql->Update('i18n',$data,array('key' => rewrite(3)));header('Location:'.location('admin/'.rewrite(2).'/'.$data['key'],true));
            }else{
              if($mysql->aArrayedResults[0]['key'] == rewrite(3)){
                $mysql->Update('i18n',$data,array('key' => rewrite(3)));header('Location:'.location('admin/'.rewrite(2).'/'.$data['key'],true));
              }else{?>
                <div class="alert alert-error">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <strong><?php echo __t('error');?></strong> &mdash; <?php echo __t('error_message_exists.2');?>
                </div>
              <?php }
            }
          }
        }?>
        <fieldset>
          <legend><?php echo __t('edit');?></legend>
          <form class="form-horizontal" action="<?php echo location('admin/'.rewrite(2).'/'.rewrite(3).'/edit'); ?>" method="POST">
            <div class="control-group">
              <label class="control-label" for="group"><?php echo __t('group');?></label>
              <div class="controls">
                <select name="group">
                  <?php $mysql->Select('i18n_groups','','id');$groups = $mysql->aArrayedResults;foreach($groups as $groupArray):?>
                  <option <?php if($data['group'] == $groupArray['id']){echo 'selected="seelected"';}?> value="<?php echo $groupArray['id'];?>"><?php echo ucwords($groupArray['name']);?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="key"><?php echo __t('key');?></label>
              <div class="controls">
                <input name="key" type="text" value="<?php echo $data['key'];?>">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="value_pt"><?php echo __t('text_in_portuguese');?></label>
              <div class="controls">
                <textarea class="textarea" name="value_pt" id="value_pt" autocomplete="off"><?php echo $data['value_pt'];?></textarea>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="value_es"><?php echo __t('text_in_spanish');?></label>
              <div class="controls">
                <textarea class="textarea" name="value_es" id="value_es" autocomplete="off"><?php echo $data['value_es'];?></textarea>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="value_en"><?php echo __t('text_in_english');?></label>
              <div class="controls">
                <textarea class="textarea" name="value_en" id="value_en" autocomplete="off"><?php echo $data['value_en'];?></textarea>
              </div>
            </div>
            <div class="control-group">
              <div class="controls">
                <button type="submit" class="btn"><?php echo __t('edit');?></button>
              </div>
            </div>
          </form>
        </fieldset>
      <?php }elseif(rewrite(4)=='delete'){
        if($_POST){
          switch($_POST['act']){
            case 0:
              header('Location:'.location('admin/'.rewrite(2).'/'.rewrite(3),true));
              break;
            case 1:
              $mysql->Delete(rewrite(2), array('key' => rewrite(3)));
              header('Location:'.location('admin/'.rewrite(2),true));
              break;
          }
        }?>
        <div class="alert alert-block">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong><?php echo __t('attention');?></strong> &mdash; <?php echo __t('delete_message.2');?>
          <hr />
          <form class="container" action="<?php echo location('admin/'.rewrite(2).'/'.rewrite(3));?>/delete" method="POST">
            <button type="submit" name="act" value="0" class="btn btn-large btn-warning"><i class="icon-ban-circle icon-white"></i> <?php echo __t('cancel');?></button>
            <button type="submit" name="act" value="1" class="btn btn-large btn-danger"><i class="icon-trash icon-white"></i> <?php echo __t('delete');?></button>
          </form>
        </div>
      <?php }?>
      <fieldset>
        <legend><?php echo __t('registered_system.system');?></legend>
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th><?php echo __t('group');?></th>
              <th><?php echo __t('key');?></th>
              <th><?php echo __t('created_by');?></th>
              <th><?php echo __t('action');?></th>
            </tr>
          </thead>
          <tbody>
            <?php $i18n = new I18n();?>
            <tr>
              <td><?php echo $i18n->getGroup($data['group']);?></td>
              <td><a href="<?php location('admin/i18n/'.$data['key']);?>"><?php echo $data['key'];?></a></td>
              <td><a target="_blank" href="<?php $user=new User($data['createdBy']); location('admin/users/'.$user->getUsername())?>"><?php echo $user->getName(true) ?></a></td>
              <td>
                <a href="<?php location('admin/'.rewrite(2).'/'.$data['key']);?>"       ><i class="icon-search"></i></a>
                <a href="<?php location('admin/'.rewrite(2).'/'.$data['key']);?>/edit"  ><i class="icon-pencil"></i></a>
                <a href="<?php location('admin/'.rewrite(2).'/'.$data['key']);?>/delete"><i class="icon-trash"></i></a>
              </td>
            </tr>
            <tr>
              <td><?php echo __t('text_in_portuguese');?></td>
              <td colspan="3"><?php echo $data['value_pt'];?></td>
            </tr>
            <tr>
              <td><?php echo __t('text_in_spanish');?></td>
              <td colspan="3"><?php echo $data['value_es'];?></td>
            </tr>
            <tr>
              <td><?php echo __t('text_in_english');?></td>
              <td colspan="3"><?php echo $data['value_en'];?></td>
            </tr>
          </tbody>
        </table>
      </fieldset>
<?php 
    }elseif(rewrite(3) == 'add'){
      extract($_POST);
      if(!isset($key) || empty($key)){
        
        echo 'ERRO!! Construir tratamento de erros';
      
      }else{
        $data = array(
          'group'     => $group,
          'key'       => str_replace(' ','_',strtolower(trim($key))),
          'value_pt'  => $value_pt,
          'value_es'  => $value_es,
          'value_en'  => $value_en,
          'createdBy' => $_SESSION['user']['authenticated']['id'],
        );
        $mysql->Select('i18n', array('key' => $data['key']));
        if($mysql->iRecords == 0){
          $mysql->Insert($data,'i18n');
          header('Location:'.location('admin/'.rewrite(2),true));
        }else{
          


        }
      }
    }
  }else{?>
<fieldset>
  <legend><?php echo __t('new');?></legend>
  <form class="form-horizontal" action="<?php echo location('admin/'.rewrite(2).'/add'); ?>" method="POST">
    <div class="control-group">
      <label class="control-label" for="group"><?php echo __t('group');?></label>
      <div class="controls">
        <select name="group">
          <?php $mysql->Select('i18n_groups','','id');$groups = $mysql->aArrayedResults;foreach($groups as $groupArray):?>
          <option value="<?php echo $groupArray['id'];?>"><?php echo ucwords($groupArray['name']);?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="key"><?php echo __t('key');?></label>
      <div class="controls">
        <input name="key" type="text"placeholder="<?php echo __t('key');?>">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="value_pt"><?php echo __t('text_in_portuguese');?></label>
      <div class="controls">
        <textarea class="textarea" name="value_pt" id="value_pt" autocomplete="off"></textarea>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="value_es"><?php echo __t('text_in_spanish');?></label>
      <div class="controls">
        <textarea class="textarea" name="value_es" id="value_es" autocomplete="off"></textarea>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="value_en"><?php echo __t('text_in_english');?></label>
      <div class="controls">
        <textarea class="textarea" name="value_en" id="value_en" autocomplete="off"></textarea>
      </div>
    </div>
    <div class="control-group">
      <div class="controls">
        <button type="submit" class="btn"><?php echo __t('register');?></button>
      </div>
    </div>
  </form>
</fieldset>
<fieldset>
  <legend><?php echo __t('registered_system.system');?></legend>
  <table class="table table-striped table-hover">
    <thead>
      <tr>
        <th><?php echo __t('group');?></th>
        <th><?php echo __t('key');?></th>
        <th><?php echo __t('created_by');?></th>
        <th><?php echo __t('action');?></th>
      </tr>
    </thead>
    <tbody>
      <?php $mysql->Select('i18n','','i18n.group,i18n.key');
        if($mysql->iRecords > 0){$i18n = new I18n();
          $i18ns = $mysql->aArrayedResults;
          foreach($i18ns as $value):
          ?>
      <tr>
        <td><?php echo $i18n->getGroup($value['group']);?></td>
        <td><a href="<?php location('admin/i18n/'.$value['key']);?>"><?php echo $value['key'];?></a></td>
        <td><a target="_blank" href="<?php $user=new User($value['createdBy']); location('admin/users/'.$user->getUsername())?>"><?php echo $user->getName(true) ?></a></td>
        <td>
          <a href="<?php location('admin/'.rewrite(2).'/'.$value['key']);?>"       ><i class="icon-search"></i></a>
          <a href="<?php location('admin/'.rewrite(2).'/'.$value['key']);?>/edit"  ><i class="icon-pencil"></i></a>
          <a href="<?php location('admin/'.rewrite(2).'/'.$value['key']);?>/delete"><i class="icon-trash"></i></a>
        </td>
      </tr>
      <?php endforeach;
        }else{?>
      <tr>
        <td colspan="4">
          <?php echo __t('no_record');?>
        </td>
      </tr>
        <?php }?>
    </tbody>
  </table>
</fieldset>
<?php }