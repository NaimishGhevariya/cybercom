<?php
$customerGroups = $this->getCustomerGroups()->getData();

?>
<form method="POST" action="<?php echo $this->getUrlObject()->getUrl('save', 'Product\Price', null, true); ?>">
	<div class="col-md-12">
		<a href="<?php echo $this->getUrlObject()->getUrl('grid', 'product'); ?>" name="back" id="back" class="btn btn-light float-start my-3"><i class="fas fa-long-arrow-alt-left"></i> Back</a>
		<button class="btn btn-primary float-end my-3" type="submit">Update</button>
	</div>

	<table class="table table-striped table-inverse table-responsive">
		<tr>
			<th>Group Id</th>
			<th>Group Name</th>
			<th>Group Price</th>
		</tr>
		<?php foreach ($customerGroups as $key => $value) : ?>
			<?php $rowStatus = ($value->entityId) ? "exist" : "new" ?>
			<tr>
				<td><?php echo $value->customerGroupId  ?></td>
				<td><?php echo $value->name ?></td>
				<td> <input type="text" value="<?php echo $value->price ?>" name="groupPrice[<?php echo $rowStatus ?>][<?php echo $value->customerGroupId ?>]"></td>
			</tr>
		<?php endforeach; ?>
	</table>

</form>