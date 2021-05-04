<?php
$collection = $this->getCollection();
$columns = $this->getColumns();
$tableName = $this->getTableName();
$buttons = $this->getButtons();
$actions = $this->getActions();
$title = $this->getTitle();

?>
<form method="POST">
    <div class="container">
        <h2 class="my-4">
            <?php if ($title) :
                echo $title;
            endif; ?>
            <?php if ($buttons) : ?>
                <?php foreach ($buttons as $key => $button) : ?>
                    <button formaction="<?php echo $this->getButtonUrl($collection, $button['method']); ?>" class="btn btn-primary float-end ms-2">
                        <?php echo $button['label']; ?>
                    </button>
                <?php endforeach; ?>
            <?php endif; ?>
        </h2>
        <hr>
    </div>
    <div class="container" id="gridTable">
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
                                <input type="<?php echo $column['type'] ?>" class="filter form-control" name="filter[<?= $tableName; ?>][<?php echo $column['field']; ?>]" value="<?php echo $column['filter']; ?>" placeholder='Filter' />
                            </th>
                        <?php endforeach; ?>
                        <th colspan="<?= sizeof($actions) ?>"> </th>
                    </tr>
                <?php endif; ?>
                <?php if ($collection) : ?>
                    <?php foreach ($collection as $row) : ?>
                        <tr>
                            <?php if ($columns) : ?>
                                <?php foreach ($columns as $key => $column) : ?>
                                    <td><?php echo $this->getFieldValue($row, $column['field']); ?></td>
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
    </div>
</form>