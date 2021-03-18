<?php
$product = $this->getTableRow();

?>
<div class="container">
    <form method="POST" action="<?php echo $this->getUrlObject()->getUrl('save', 'product', null, true); ?>">
        <div class="row">
            <div class="col-md-5 m-3">
                <label for="sku" class="form-label"><b>sku</b></label>
                <input type="text" class="form-control" name="product[sku]" id="sku" placeholder="SKU" value="<?php echo $product->sku; ?>">
            </div>
            <div class="col-md-5 m-3">
                <label for="name" class="form-label"><b>Name</b></label>
                <input type="text" class="form-control" name="product[name]" id="name" placeholder="Name" value="<?php echo $product->name; ?>">
            </div>
        </div>
        <div class="row">

            <div class="col-md-5 m-3">
                <label for="price" class="form-label"><b>Price</b></label>
                <input type="text" class="form-control" name="product[price]" id="price" placeholder="Price" value="<?php echo $product->price; ?>">
            </div>
            <div class="col-md-5 m-3">
                <label for="discount" class="form-label"><b>Discount</b></label>
                <input type="text" class="form-control" name="product[discount]" id="discount" placeholder="Discount" value="<?php echo $product->discount; ?>">
            </div>
        </div>
        <div class="row">

            <div class="col-md-5 m-3">
                <label for="description" class="form-label"><b>Description</b></label>
                <input type="text" class="form-control" name="product[description]" id="description" placeholder="Description" value="<?php echo $product->description; ?>">
            </div>
            <div class="col-md-5 m-3">
                <label for="quantity" class="form-label"><b>Quantity</b></label>
                <input type="number" class="form-control" name="product[quantity]" id="quantity" placeholder="Quantity" value="<?php echo $product->quantity; ?>">
            </div>
        </div>
        <div class="row">

            <input type="text" name="product[updatedDate]" value="<?php date_default_timezone_set("Asia/Kolkata");
                                                                    echo date('Y-m-d H:i:s') ?>" hidden>
            <div class="col-md-5 m-3">
                <label for="status" class="form-label"><b>Status</b></label>
                <select class="custom-select form-control" name="product[status]">
                    <?php
                    foreach ($product->getStatusOptions() as $key => $value) { ?>
                        <option class="form-control" value="<?php echo $key; ?>" <?php if ($product->status == $key) echo "selected"; ?>>
                            <?php echo $value; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <a href="<?php echo $this->getUrlObject()->getUrl('grid'); ?>" name="back" id="back" class="btn btn-light"><i class="fas fa-long-arrow-alt-left"></i> Back</a>
        <button name="submit" id="submit" class="btn btn-primary m-3"><i class="fas fa-plus"></i> <?php echo $this->getButton(); ?></button>
    </form>
</div>