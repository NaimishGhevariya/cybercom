<?php
$result = $this->getOptions();
?>
<script type="text/javascript" src="<?php echo  $this->baseUrl('Skin/Admin/Js/options.js') ?> "> </script>

<div class="container">
    <h2 class="my-4">
        <?php //echo $this->getTitle();
        ?>
    </h2>

    <form action="<?php $this->getUrlObject()->getUrl('update') ?>" method="POST">
        <a href="<?php echo $this->getUrlObject()->getUrl('grid'); ?>" name="back" id="back" class="btn btn-light"><i class="fas fa-long-arrow-alt-left"></i> Back</a>

        <button type="button" class="btn btn-primary float-end" onclick="addRow()"><i class="fas fa-plus"></i> Add Option</button>
        <button type='submit' class="btn btn-primary float-end mx-3"><i class="fas fa-pen"></i> Update</button>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Attribute Id </th>
                    <th>Name</th>
                    <th>Sort Order</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <tr id='newRow' hidden>
                    <td><?php echo "" ?></td>
                    <td><input type="text" value="<?php echo 1; ?>" disabled></td>
                    <td><input type="text" name="option['new'][name]"></td>
                    <td><input type="text" name="option['new'][sortOrder]"></td>
                    <td><a onclick="removeRow(this)"><i class="fas fa-trash-alt" style="color:tomato"></i></a></td>
                </tr>
                <?php foreach ($result as $row) :
                ?>
                    <tr>
                        <td><?php echo $row->optionId ?></td>
                        <td><input type="text" value="<?php echo $row->attributeId ?>" disabled></td>
                        <td><input type="text" value="<?php echo $row->name ?>" name="option[<?php echo ($row->optionId) ? 'exist' : 'new'; ?>][name]"></td>
                        <td><input type="text" value="<?php echo $row->sortOrder ?>" name="option[<?php echo ($row->optionId) ? 'exist' : 'new'; ?>][sortOrder]"></td>
                        <td><a <?php if ($row->optionId) : ?> href="<?php echo $this->getUrlObject()->getUrl('deleteOption', NULL, ['id' => "$row->optionId"], true); ?>" <?php else : ?> onclick="removeRow()" <?php endif; ?>><i class="fas fa-trash-alt" style="color:tomato"></i></a></td>
                    </tr>
                <?php endforeach;
                ?>
            </tbody>
        </table>
    </form>


</div>