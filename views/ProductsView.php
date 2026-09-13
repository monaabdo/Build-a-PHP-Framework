<?php $this->layout("layout",["title"=>"Products"]) ?>
<h1>List of products</h1>
<p>
    <a href="/">Home </a> |
    <a href="/product/new">Add New Product</a>

</p>
<table>
    <tr>
        <th>ID</th>
        <th>Product Name</th>
        <th>Description</th>
        <th>Size</th>
    <?php foreach($products as $product): ?>
        <tr>
            <td><?= $product->getID(); ?></td>
            <td><a href="<?="product/".$product->getId(); ?>"><?= $this->e($product->getName()); ?></a></td>
            <td><?= $this->e($product->getDescription()); ?></td>
            <td><?= $product->getSize(); ?></td>
        </tr>
        <?php endforeach; ?> 
    </table>