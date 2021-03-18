<?php
$result = $this->getAttributes()->getData();

?>
<div class="container">
    <h2 class="my-4">
        <?php echo $this->getTitle(); ?>
        <a class="btn btn-primary float-end" href="<?php echo $this->getUrlObject()->getUrl('form'); ?>"><i class="fas fa-plus"></i> Add</a>
    </h2>
    <hr>
    <h4><?php if (!$result) {
            echo "No Record Found";
            die();
        } ?></h4>


    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>entityTypeId</th>
                <th>Name</th>
                <th>code</th>
                <th>inputType</th>
                <th>backendType</th>
                <th>sortOrder</th>
                <th>backendModel</th>
                <th colspan="3">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($result as $row) :
            ?>
                <tr>
                    <td><?php echo $row->attributeId
                        ?></td>
                    <td><?php echo $row->entityTypeId
                        ?></td>
                    <td><?php echo $row->name
                        ?></td>
                    <td><?php echo $row->code
                        ?></td>
                    <td><?php echo $row->inputType
                        ?></td>
                    <td><?php echo $row->backendType
                        ?></td>
                    <td><?php echo $row->sortOrder
                        ?></td>
                    <td><?php echo $row->backendModel
                        ?></td>

                    <td><a href="<?php echo $this->getUrlObject()->getUrl('form', NULL, ['id' => "$row->attributeId"], TRUE); ?>"><i class="fas fa-pen"></i></a></td>
                    <td><a href="<?php echo $this->getUrlObject()->getUrl('delete', NULL, ['id' => "$row->attributeId"], TRUE); ?>"><i class="fas fa-trash-alt" style="color:tomato"></i></a></td>
                </tr>

            <?php endforeach;
            ?>
        </tbody>
    </table>
</div>