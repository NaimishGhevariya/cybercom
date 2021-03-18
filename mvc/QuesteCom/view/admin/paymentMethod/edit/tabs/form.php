<?php
$paymentMethod = $this->getTableRow();
?>
<div class="container">

    <form method="POST" action="<?php echo $this->getUrlObject()->getUrl("save", null, ['id' => $paymentMethod->methodId], true); ?>">

        <div class="row">
            <div class="col-md-5 m-3">
                <label for="name" class="form-label"><b>Name</b></label>
                <input type="text" class="form-control" name="paymentMethod[name]" id="name" placeholder="Payment Method Name" value="<?php echo $paymentMethod->name; ?>">
            </div>
            <div class="col-md-5 m-3">
                <label for="code" class="form-label"><b>Code</b></label>
                <input type="text" class="form-control" name="paymentMethod[code]" id="code" placeholder="Payment Method Code" value="<?php echo $paymentMethod->code; ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-md-5 m-3">
                <label for="description" class="form-label"><b>Description</b></label>
                <input type="text" class="form-control" name="paymentMethod[description]" id="description" placeholder="Payment Method Description" value="<?php echo $paymentMethod->description; ?>">
            </div>
            <div class="col-md-5 m-3">
                <label for="status" class="form-label"><b>Status</b></label>
                <select class="custom-select form-control" name="paymentMethod[status]">
                    <?php
                    foreach ($paymentMethod->getStatusOptions() as $key => $value) { ?>
                        <option class="form-control" value="<?php echo $key; ?>" <?php if ($paymentMethod->status == $key) echo "selected"; ?>>
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