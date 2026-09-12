<?php $this->layout("layout",['title' => ' Add New Product']) ?>
<h1> ADD New Product</h1>
<form action="/product/store" method="post">
    <div>
        <label for="name">Product Name </label>
        <input type="text" name="name" />
    </div>
    <div>
        <label for="description">Product Description </label>
        <textarea name="description"></textarea>
    </div>
    <div>
        <label for="size">Product Size </label>
        <input type="number" name="size" min="0"/>
    </div>
    <button type="submit">ADD Product</button>
</form>