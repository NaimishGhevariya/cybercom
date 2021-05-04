<?php
$product = $this->getTableRow();
$attributes = $this->getAttributes();
?>

<div class="container">
    <form method="POST" action="<?php echo $this->getUrlObject()->getUrl("save", null, null, true); ?>">
        <?php foreach ($attributes->getData() as $key => $value) : ?>

            <?php if ($value->inputType == "checkbox") : ?>
                <?php $options = $this->getOptions($value->attributeId); ?>
                <div class="my-3">
                    <div>
                        <label class="form-check-label"><b><?php echo $value->name; ?></b></label>
                    </div>
                    <?php foreach ($options->getData() as $key => $option) : ?>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="product[<?php echo $value->name; ?>][]" value="<?php echo $option->name ?>" id="<?php echo $option->name; ?>" <?php
                                                                                                                                                                                                $x = $value->name;
                                                                                                                                                                                                $multiple = explode(',', $product->$x);
                                                                                                                                                                                                if (in_array($option->name, $multiple)) {
                                                                                                                                                                                                    echo 'checked';
                                                                                                                                                                                                }
                                                                                                                                                                                                ?>>
                            <label class="form-check-label" for="<?php echo $option->name; ?>"><?php echo $option->name ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>

            <?php elseif ($value->inputType == 'radio') : ?>
                <?php $options = $this->getOptions($value->attributeId); ?>
                <div class="my-3">
                    <div>
                        <label class="form-check-label"><b><?php echo $value->name; ?></b></label>
                    </div>
                    <?php foreach ($options->getData() as $key => $option) : ?>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="product[<?php echo $value->name; ?>]" value="<?php echo $option->name ?>" id="<?php echo $option->name; ?>" <?php
                                                                                                                                                                                            $x = $value->name;
                                                                                                                                                                                            if ($option->name == $product->$x) {
                                                                                                                                                                                                echo 'checked';
                                                                                                                                                                                            }
                                                                                                                                                                                            ?>>
                            <label class="form-check-label" for="<?php echo $option->name; ?>"><?php echo $option->name ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>

            <?php elseif ($value->inputType == 'select') : ?>
                <?php $options = $this->getOptions($value->attributeId) ?>

                <div class="my-3">
                    <div>
                        <label class="form-label"><b><?php echo $value->name; ?></b></label>
                    </div>
                    <div class="col-md-5">
                        <select class="form-select" name="product[<?php echo $value->name; ?>]" id="<?php echo $value->name; ?>">
                            <option value="0" disabled selected>Select <?php echo $value->name; ?></option>
                            <?php foreach ($options->getData() as $key => $option) : ?>
                                <option value="<?php echo $option->name ?>" <?php
                                                                            $x = $value->name;
                                                                            if ($option->name == $product->$x) {
                                                                                echo 'selected';
                                                                            }
                                                                            ?>><?php echo $option->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

            <?php elseif ($value->inputType == 'text') : ?>
                <div class="col-md-5 my-3">
                    <label class="form-label"><b><?php echo $value->name; ?></b></label>
                    <input type="text" class="form-control" name="product[<?php echo $value->name; ?>]" id="<?php echo $value->name; ?>" placeholder="Enter value" value="<?php $x = $value->name;
                                                                                                                                                                            echo $product->$x; ?>">
                </div>

            <?php elseif ($value->inputType == 'textarea') : ?>
                <?php $options = $this->getOptions($value->attributeId) ?>
                <div class="col-md-5 my-3">
                    <label class="form-label"><b><?php echo $value->name; ?></b></label>
                    <textarea class="form-control" name="product[<?php echo $value->name; ?>]" id="<?php echo $value->name; ?>" cols="30" rows="5"><?php $x = $value->name;
                                                                                                                                                    echo $product->$x; ?></textarea>
                </div>

            <?php endif; ?>
        <?php endforeach; ?>
        <a href="<?php echo $this->getUrlObject()->getUrl('grid'); ?>" name="back" id="back" class="btn btn-light"><i class="fas fa-long-arrow-alt-left"></i> Back</a>
        <button name="submit" id="submit" class="btn btn-primary my-3"><?php echo $this->getButton(); ?></button>
    </form>

</div>