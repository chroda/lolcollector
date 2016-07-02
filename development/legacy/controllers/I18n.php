  <?php
  require_once(__CONTROLLERS_DIR__.'MySQL.php');
  final class I18n{
    private $mysql;
    private $locale;
    private $priorityOfLanguage;
    
    public function __construct(array $orderPriority = array('en','es','pt')){
      $this->mysql = new MySQL;
      $this->locale = isset($_SESSION['user']['locale'])?$_SESSION['user']['locale']:__LOCALE__;
      $this->priorityOfLanguage = $orderPriority;
    }
    public function getGroup($_id){
      $this->mysql->Select('i18n_groups', array('id' => $_id));
      return $this->mysql->aArrayedResults[0]['name'];
    }
    public function getCreator($_id){
      $user = new User($_id);
      return $user->getName(true);
    }
    public function translate($_query){
      $parameters = explode('.', strtolower($_query));
      isset($parameters[1])?$group=$parameters[1]:$group=1;$key=$parameters[0];
      if(!is_numeric($group)){
        $this->mysql->Select('i18n_groups', array('name' => $group));
        if($this->mysql->iRecords == 0){return 'Sorry, this group don\'t exist';}
        $group = $this->mysql->aArrayedResults[0]['id'];
      }
      $query = array(
        'group'  => $group,
        'key'    => $key
      );
      $this->mysql->Select('i18n', $query);
      if($this->mysql->iRecords == 1){
        $translatios = $this->mysql->aArrayedResults[0];
        return $this->queue($translatios);
      }else{return 'Sorry, this key ['.$key.'] not found, are you in the right group? ['.$group.']';}
    }
    private function queue($_translatios){
      $linking = array_flip($this->priorityOfLanguage);
      $linking['en'] = $_translatios['value_en'];
      $linking['es'] = $_translatios['value_es'];
      $linking['pt'] = $_translatios['value_pt'];
      foreach($linking as $locale => $translation):
        if($this->locale == $locale){
          if(!empty($translation)){return $translation;}
          $translation = $linking[$this->priorityOfLanguage[0]];if(!empty($translation)){return $translation;}
          $translation = $linking[$this->priorityOfLanguage[1]];if(!empty($translation)){return $translation;}
          $translation = $linking[$this->priorityOfLanguage[2]];if(!empty($translation)){return $translation;}
          return 'Sorry, this key have no trasnlation';
        }
      endforeach;
    }
  }
?>