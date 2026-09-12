<?php $this->layout("layout",["title"=>"Show Page"]) ?>
<h1>Show Product (<?= $product->getName()?>) Details</h1>
<p><b>Name:</b> <?= $product->getName() ?></p>
<p><b>Description:</b>  <?= $product->getDescription() ?></p>
<p> <b>Size:</b> <?= $product->getSize() ?> </p>