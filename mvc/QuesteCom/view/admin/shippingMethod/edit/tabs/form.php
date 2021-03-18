<?php
$shippingMethod = $this->getTableRow();

?>

<div class="container">

    <form method="POST" action="<?php echo $this->getUrlObject()->getUrl("save", null, null, true); ?>">

        <div class="row">
            <div class="col-md-5 m-3">
                <label for="name" class="form-label"><b>Name</b></label>
                <input type="text" class="form-control" name="shippingMethod[name]" id="name" placeholder="Shipping Method Name" value="<?php echo $shippingMethod->name; ?>">
            </div>
            <div class="col-md-5 m-3">
                <label for="code" class="form-label"><b>Code</b></label>
                <input type="text" class="form-control" name="shippingMethod[code]" id="code" placeholder="Shipping Method Code" value="<?php echo $shippingMethod->code; ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-md-5 m-3">
                <label for="description" class="form-label"><b>Description</b></label>
                <input type="text" class="form-control" name="shippingMethod[description]" id="description" placeholder="Shipping Method Description" value="<?php echo $shippingMethod->description; ?>">
            </div>
            <div class="col-md-5 m-3">
                <label for="amount" class="form-label"><b>Amount</b></label>
                <input type="text" class="form-control" name="shippingMethod[amount]" id="code" placeholder="Shipping Method Code" value="<?php echo $shippingMethod->amount; ?>">
            </div>

        </div>
        <div class="row">
            <div class="col-md-5 m-3">
                <label for="status" class="form-label"><b>Status</b></label>
                <select class="custom-select form-control" name="shippingMethod[status]">
                    <?php
                    foreach ($shippingMethod->getStatusOptions() as $key => $value) { ?>
                        <option class="form-control" value="<?php echo $key; ?>" <?php if ($shippingMethod->status == $key) echo "selected"; ?>>
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