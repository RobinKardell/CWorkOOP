<!DOCTYPE html>
<html>
<head>
    <title>CWork - {PROJEKTNAMN}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
<div class="container">
  <div class="navbar-brand">{PROJEKTNAMN}</div>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <?php
      $a='';
      foreach($headerInfo['menu'] as $menuLink){
        if($menuLink.'.php' == URI::getActivePage()){
          ?>
          <li class="nav-item active">
        <a class="nav-link" href="<?php echo $menuLink.".php"; ?>"><?php echo $menuLink; ?></a>
      </li><?php
        }else {
      ?>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo $menuLink.".php"; ?>"><?php echo $menuLink; ?></a>
      </li>
      <?php
      }
      }
      ?>
    </ul>
  </div>
  </div>
</nav>