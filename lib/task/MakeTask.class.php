<?php

class MakeTask extends sfDoctrineBaseTask
{
  protected function configure()
  {
    $this->namespace        = 'tjm';
    $this->name             = 'make';


    $this->addOptions(array(
      new sfCommandOption('community', null, sfCommandOption::PARAMETER_NONE, 'community'),
    ));


    $this->briefDescription = 'Install OpenPNE';
    $this->detailedDescription = <<<EOF
The [openpne:install|INFO] task installs and configures OpenPNE.
Call it with:

  [./symfony openpne:install|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    $databaseManager = new sfDatabaseManager($this->configuration);
    if($options['community']){
      $this->makeCommunity();
    }else{
      $this->makeMember();
    }
  }
  private function makeMember(){
    for($i=0;$i<7000;$i++){
      $m = new Member();
      $m->is_active = 1;
      $m->save();
      $name = "DO民ID:".$m->id;
      $m->name = $name; 
      $m->save();
    }
  }
  private function makeCommunity(){
    for($i=0;$i<7000;$i++){
      $obj = new Community();
      $obj->save();
      $obj->name = "コミュニティ " . $obj->id;
      $obj->save();
    }
  }
}



