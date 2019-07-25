<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<?php foreach ($metas as $meta) {
    if($meta->getContent()!='') {
      echo '<meta name="'.$meta->getName().'" content="'.$meta->getContent().'">';
    }
}?>