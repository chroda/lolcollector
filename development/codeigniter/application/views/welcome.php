<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>LOL COLLECTOR</title>
  </head>
  <body>
    <h1>LOL COLLECTOR <small><?php echo anchor('https://github.com/chroda/lolcollector','You can see the project in Github',['target'=>'_blank']);?></small></h1>
    <hr/>
    <h2>Some tests... hello word?</h2>
    <ul>
      <li><?php echo anchor(site_url(),'home page'); ?></li>
      <li><?php echo anchor('api/lolc/users','users test api'); ?></li>
    </ul>
  </body>
</html>
