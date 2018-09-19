<?php
  if(count($errors) > 0 ){
    echo '<div class="alert alert-danger">';
    if(count($errors) > 1){
      echo '<strong>Errors : </strong>';
    }else{
      echo '<strong>Error : </strong>';
    }
    echo '<ul>';
    foreach ($errors->all() as $error) {
      echo '<li>'.$error.'</li>';
    }
    echo '<ul>';
    echo '</div>';
  }
?>
