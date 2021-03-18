<?php if (!$this->validCustomer()) : ?>
    <h3>Please Register First</h3>
<?php else : ?>
    <?php
    $billing = $this->getBillingAddress();
    $shipping = $this->getShippingAddress();
    ?>
    <div class="container">

        <form method="POST" action='<?php echo $this->getUrlObject()->getUrl("saveAddress", null, null, true); ?>'>

            <div class="row">
                <div class="col-md-5">
                    <h4>Shipping Address</h4>
                    <hr>
                    <label for="address" class="form-label my-3"><b>Address</b></label>
                    <input type="text" class="form-control" name="shipping[address]" id="address" value="<?php echo $shipping->address; ?>" placeholder="Customer Address">
                    <label for="city" class="form-label my-3"><b>City</b></label>
                    <input type="text" class="form-control " name="shipping[city]" id="city" value="<?php echo $shipping->city; ?>" placeholder="City">
                    <label for="state" class="form-label my-3"><b>State</b></label>
                    <input type="text" class="form-control" name="shipping[state]" id="state" value="<?php echo $shipping->state; ?>" placeholder="State">
                    <label for="country" class="form-label my-3"><b>Country</b></label>
                    <input type="text" class="form-control" name="shipping[country]" id="country" value="<?php echo $shipping->country; ?>" placeholder="Country">
                    <label for="zipcode" class="form-label my-3"><b>Zipcode</b></label>
                    <input type="text" class="form-control" name="shipping[zipcode]" id="zipcode" value="<?php echo $shipping->zipcode; ?>" placeholder="Zip-Code">
                </div>
                <div class="col-md-5">
                    <h4>Billing Address</h4>
                    <hr>
                    <label for="address" class="form-label my-3"><b>Address</b></label>
                    <input type="text" class="form-control" name="billing[address]" id="address" value="<?php echo $billing->address; ?>" placeholder="Customer Address">
                    <label for="city" class="form-label my-3"><b>City</b></label>
                    <input type="text" class="form-control " name="billing[city]" id="city" value="<?php echo $billing->city; ?>" placeholder="City">
                    <label for="state" class="form-label my-3"><b>State</b></label>
                    <input type="text" class="form-control" name="billing[state]" id="state" value="<?php echo $billing->state; ?>" placeholder="State">
                    <label for="country" class="form-label my-3"><b>Country</b></label>
                    <input type="text" class="form-control" name="billing[country]" id="country" value="<?php echo $billing->country; ?>" placeholder="Country">
                    <label for="zipcode" class="form-label my-3"><b>Zipcode</b></label>
                    <input type="text" class="form-control" name="billing[zipcode]" id="zipcode" value="<?php echo $billing->zipcode; ?>" placeholder="Zip-Code">
                </div>
            </div>

            <a href="<?php echo $this->getUrlObject()->getUrl('grid'); ?>" name="back" id="back" class="btn btn-light"><i class="fas fa-long-arrow-alt-left"></i> Back</a>
            <button name="submit" id="submit" class="btn btn-primary m-3"><i class="fas fa-plus"></i> <?php echo $this->getButton(); ?></button>
        </form>
    </div>
<?php endif; ?>