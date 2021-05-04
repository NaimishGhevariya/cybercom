<?php
$billing = $this->getBillingAddress();
$customer = $this->getCustomer();
$product = $this->getProduct();
$cartItem = $this->getCartItem()->getData();
$cart = $this->getCart();
?>

<form action="" method="POST">
    <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-header p-4">
                <div class="float-end">
                    <h3 class="mb-0">Invoice</h3>
                    <?php date_default_timezone_set("Asia/Calcutta");
                    echo date('d M Y'); ?>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-sm-6 ">
                        <h5 class="mb-3">To:</h5>
                        <h3 class="text-dark mb-1"><?php echo $customer->firstName ?> <?php echo $customer->lastName ?></h3>
                        <div><?php echo $billing->address ?>,</div>
                        <div><?php echo $billing->city ?> - <?php echo $billing->zipcode ?>,</div>
                        <div><?php echo $billing->state ?> - <?php echo $billing->country ?></div>
                        <div><?php echo $customer->email ?></div>
                        <div>Phone: +91 <?php echo $customer->mobile ?></div>
                    </div>
                </div>
                <div class="table-responsive-sm">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="center">#</th>
                                <th class="center">SKU</th>
                                <th>Item</th>
                                <!-- <th>Description</th> -->
                                <th class="right">Price</th>
                                <th class="center">Qty</th>
                                <th class="center">Discount</th>
                                <th class="right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($product as $key => $value) : ?>
                                <tr>
                                    <td class="center"><?php echo $key + 1  ?></td>
                                    <td class="left strong"><?php echo $value['sku'] ?></td>
                                    <td class="left strong"><?php echo $value['name'] ?></td>
                                    <!-- <td class="left"><?php //echo $value['description'] 
                                                            ?></td> -->
                                    <td class="right"><?php echo $cartItem[$key]->changedPrice ?></td>
                                    <td class="center"><?php echo $cartItem[$key]->quantity ?></td>
                                    <td class="right"><?php echo $cartItem[$key]->discount ?></td>
                                    <td class="right"><?php echo (($cartItem[$key]->changedPrice) * ($cartItem[$key]->quantity) - ($cartItem[$key]->discount)) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-8"></div>
                    <div class="col-4">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td class="left">
                                        <strong class="text-dark">Total Discount :</strong>
                                    </td>
                                    <td class="right">
                                        <strong class="text-dark"><?php echo $cart->discount;
                                                                    ?></strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong class="text-dark">Shipping Amount :</strong>
                                    </td>
                                    <td class="right">
                                        <strong class="text-dark"><?php echo $cart->shippingAmount;
                                                                    ?></strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong class="text-dark">Grand Total :(&#8377;)</strong>
                                    </td>
                                    <td class="right">
                                        <strong class="text-dark"><?php echo $cart->total; ?></strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <a href="<?php echo $this->getUrlObject()->getUrl('checkout', 'Cart\Checkout', 'cart'); ?>" name="back" id="back" class="btn btn-light"><i class="fas fa-long-arrow-alt-left"></i> Back</a>
        <button name="submit" id="submit" class="btn btn-primary m-3" formaction="<?php //echo $this->getUrlObject()->getUrl('save', 'Order', null, true); 
                                                                                    ?>">Print</button>
    </div>

</form>