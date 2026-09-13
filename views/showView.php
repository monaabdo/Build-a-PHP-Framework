<?php $this->layout("layout",["title"=>"Show Page"]) ?>
<p>
    <a href="/">Home </a> |
    <a href="/products">Products List</a>

</p>
<h1>Show Product (<?= $product->getName()?>) Details</h1>
<p><b>Name:</b> <?= $product->getName() ?></p>
<p><b>Description:</b>  <?= $product->getDescription() ?></p>
<p> <b>Size:</b> <?= $product->getSize() ?> </p>