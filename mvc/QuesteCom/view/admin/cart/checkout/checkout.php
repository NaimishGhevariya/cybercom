<?php
$billing = $this->getBillingAddress();
$shipping = $this->getShippingAddress();
$paymentMethod = $this->getPaymentMethod();
$shippingMethod = $this->getShippingMethod();
$orderDetails = $this->getOrderDetails();
?>
<div class="container">

    <form method="POST">

        <div class="row my-4">
            <div class="col-md-5">
                <h4>Billing Address</h4>
                <hr>
                <label for="address" class="form-label my-3"><b>Address</b></label>
                <input type="text" class="form-control" name="billing[address]" id="address" value="<?php if ($billing) {
                                                                                                        echo $billing->address;
                                                                                                    }  ?>" placeholder="Customer Address">
                <label for="city" class="form-label my-3"><b>City</b></label>
                <input type="text" class="form-control " name="billing[city]" id="city" value="<?php if ($billing) {
                                                                                                    echo $billing->city;
                                                                                                }  ?>" placeholder="City">
                <label for="state" class="form-label my-3"><b>State</b></label>
                <input type="text" class="form-control" name="billing[state]" id="state" value="<?php if ($billing) {
                                                                                                    echo $billing->state;
                                                                                                } ?>" placeholder="State">
                <label for="country" class="form-label my-3"><b>Country</b></label>
                <input type="text" class="form-control" name="billing[country]" id="country" value="<?php if ($billing) {
                                                                                                        echo $billing->country;
                                                                                                    } ?>" placeholder="Country">
                <label for="zipcode" class="form-label my-3"><b>Zipcode</b></label>
                <input type="text" class="form-control" name="billing[zipcode]" id="zipcode" value="<?php if ($billing) {
                                                                                                        echo $billing->zipcode;
                                                                                                    } ?>" placeholder="Zip-Code">
                <div class="form-check my-3">
                    <input type="checkbox" class="form-check-input" name="saveBillingFlag" id="billingSaveFlag">
                    <label for="billingSaveFlag" class="form-check-label">Save To Addressbook</label>
                </div>
            </div>
            <div class="col-md-5">
                <h4>Shipping Address</h4>
                <hr>
                <label for="address" class="form-label my-3"><b>Address</b></label>
                <input type="text" class="form-control" name="shipping[address]" id="address" value="<?php if ($shipping) {
                                                                                                            echo ($shipping->address);
                                                                                                        } ?>" placeholder="Customer Address">
                <label for="city" class="form-label my-3"><b>City</b></label>
                <input type="text" class="form-control " name="shipping[city]" id="city" value="<?php if ($shipping) {
                                                                                                    echo $shipping->city;
                                                                                                } ?>" placeholder="City">
                <label for="state" class="form-label my-3"><b>State</b></label>
                <input type="text" class="form-control" name="shipping[state]" id="state" value="<?php if ($shipping) {
                                                                                                        echo $shipping->state;
                                                                                                    } ?>" placeholder="State">
                <label for="country" class="form-label my-3"><b>Country</b></label>
                <input type="text" class="form-control" name="shipping[country]" id="country" value="<?php if ($shipping) {
                                                                                                            echo $shipping->country;
                                                                                                        }  ?>" placeholder="Country">
                <label for="zipcode" class="form-label my-3"><b>Zipcode</b></label>
                <input type="text" class="form-control" name="shipping[zipcode]" id="zipcode" value="<?php if ($shipping) {
                                                                                                            echo $shipping->zipcode;
                                                                                                        } ?>" placeholder="Zip-Code">
                <div class="form-check my-3">
                    <input type="checkbox" class="form-check-input" name="shipping[sameFlag]" id="sameFlag">
                    <label for="sameFlag" class="form-check-label">Same as billing</label>
                </div>
                <div class="form-check my-3">
                    <input type="checkbox" class="form-check-input" name="saveShippingFlag" id="shippingSaveFlag">
                    <label for="shippingSaveFlag" class="form-check-label">Save To Addressbook</label>
                </div>
            </div>
        </div>

        <div class="row my-4">
            <div class="col-md-5">
                <h4>Payment Methods</h4>
                <hr>
                <div class="form-check my-3">
                    <?php foreach ($paymentMethod->getData() as $key => $paymentMethod) : ?>
                        <div class="form-check my-3">
                            <input type="radio" class="form-check-input" name="paymentMethod" value="<?php echo $paymentMethod->methodId ?>" id="<?php echo $paymentMethod->name ?>">
                            <label for="<?php echo  $paymentMethod->name ?>" class="form-check-label"><?php echo $paymentMethod->name ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-md-5">
                <h4>Shipping Methods</h4>
                <hr>
                <div class="form-check my-3">
                    <?php foreach ($shippingMethod->getData() as $key => $shippingMethod) : ?>
                        <div class="form-check my-3">
                            <input type="radio" class="form-check-input" name="shippingMethod" value="<?php echo $shippingMethod->methodId ?>" id="<?php echo $shippingMethod->name ?>">
                            <label for="<?php echo  $shippingMethod->name ?>" class="form-check-label"><?php echo $shippingMethod->name ?> - (Amount: <?php echo $shippingMethod->amount ?>)</label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <a href="<?php echo $this->getUrlObject()->getUrl('grid', 'cart', null, true); ?>" name="back" id="back" class="btn btn-light"><i class="fas fa-long-arrow-alt-left"></i> Back</a>
        <button name="submit" id="submit" class="btn btn-primary m-3" formaction="<?php echo $this->getUrlObject()->getUrl('test', 'cart\checkout', null, true); ?>">Proceed to next</button>
    </form>
</div>