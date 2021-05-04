<?php
$collection = $this->getCollection();
$columns = $this->getColumns();
$buttons = $this->getButtons();
$actions = $this->getActions();
$title = $this->getTitle();
$customerList = $this->getCustomerList();
$products = $this->getProducts();
// echo '<pre>';
// print_r($products);
// die();
?>
<form method="POST">
    <div class="container my-4">
        <h2 class="my-4">
            <?php if ($title) :
                echo $title;
            endif; ?>
            <?php if ($buttons && $collection) : ?>
                <?php foreach ($buttons as $key => $button) : ?>
                    <?php if ($key != 'checkout') : ?>
                        <button formaction="<?php echo $this->getButtonUrl($collection[0], $button['method']); ?>" class="btn btn-primary float-end ms-2">
                            <?php echo $button['label']; ?>
                        </button>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </h2>
        <div class="column my-4">
            <div class="col-md-10 float-start">
                <select class="form-control my-2" name="activeCustomer">
                    <option value="">Select Customer</option>
                    <?php foreach ($customerList as $Key => $customer) : ?>
                        <option value="<?= $customer->customerId ?>" <?php if ($this->getActiveCustomerId() == $customer->customerId) {
                                                                            echo 'selected';
                                                                        } ?>><?= $customer->firstName ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2 float-end my-2">
                <button type="submit" class="btn btn-primary mx-2" formaction="<?php echo $this->getActiveCustomerActionUrl(); ?>">Go</button>
            </div>
        </div>

        <hr>
    </div>
    <div class="container my-4" id="gridTable">
        <h4>
            <?php if (!$collection) : ?>
                No Record Found
                <?php die; ?>
            <?php endif; ?>
        </h4>

        <table class="table table-striped table-hover">
            <thead>
                <?php if ($columns) : ?>
                    <tr>
                        <?php foreach ($columns as $key => $column) : ?>
                            <th><?php echo $column['label'] ?></th>
                        <?php endforeach; ?>
                        <?php if ($actions) : ?>
                            <th colspan="<?= sizeof($actions) ?>">Actions</th>
                        <?php endif; ?>
                    </tr>
                <?php endif; ?>
            </thead>
            <tbody>
                <?php if ($columns) : ?>
                    <tr>
                        <?php foreach ($columns as $key => $column) : ?>
                            <th>
                                <input type="text" class="filter form-control" name="filter[<?php echo $column['field']; ?>]" value="<?php echo $column['filter']; ?>" disabled />
                            </th>
                        <?php endforeach; ?>
                        <th colspan="<?= sizeof($actions) ?>"> </th>
                    </tr>
                <?php endif; ?>
                <?php $i = 0; ?>
                <?php if ($collection) : ?>
                    <?php foreach ($collection as $row) : ?>
                        <tr>
                            <?php if ($columns) :  ?>
                                <?php foreach ($columns as $key => $column) : ?>
                                    <?php if ($key == 'productName') : ?>
                                        <td><?php echo $products[$i]['name'];
                                            $i++; ?></td>
                                    <?php else : ?>
                                        <?php if ($key == 'quantity') : ?>
                                            <td><input type="number" class="form-control" min=1 name="<?php echo $this->getFieldValue($row, 'cartItemId'); ?>[quantity]" value="<?php echo $this->getFieldValue($row, $column['field']); ?>" /></td>
                                        <?php else : ?>
                                            <?php if ($key == 'discount') : ?>
                                                <td><?php echo ($this->getFieldValue($row, 'discount')); ?></td>
                                            <?php else : ?>
                                                <?php if ($key == 'changedPrice') : ?>
                                                    <td><input type="number" class="form-control" name="<?php echo $this->getFieldValue($row, 'cartItemId'); ?>[changedPrice]" value="<?php echo $this->getFieldValue($row, 'changedPrice'); ?>" /></td>
                                                <?php else : ?>
                                                    <?php if ($key == 'totalPrice') : ?>
                                                        <td><?php echo (($this->getFieldValue($row, 'quantity')) * ($this->getFieldValue($row, 'changedPrice')) - ($this->getFieldValue($row, 'discount'))); ?></td>
                                                    <?php else : ?>
                                                        <td><?php echo $this->getFieldValue($row, $column['field']); ?></td>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <?php if ($actions) : ?>
                                <?php foreach ($actions as $key => $action) : ?>
                                    <td>
                                        <a href="<?php echo $this->getMethodUrl($row, $action['method']); ?>"><?php echo $action['label'] ?></a>
                                    </td>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>

            </tbody>
        </table>

        <button formaction="<?php echo $this->getButtonUrl($collection[0], $buttons['checkout']['method']); ?>" class="btn btn-primary float-end ms-2">
            <?php echo $button['label']; ?>
        </button>
    </div>

</form>