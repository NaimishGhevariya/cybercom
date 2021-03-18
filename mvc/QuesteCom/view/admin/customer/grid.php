<?php
$result = $this->getCustomers();
?>
<div class="container">
	<h2 class="my-4">
		<?php echo $this->getTitle(); ?>
		<a class="btn btn-primary float-end" href="<?php echo $this->getUrlObject()->getUrl('form', null, NULL, TRUE); ?>"><i class="fas fa-plus"></i> Add</a>
	</h2>
	<hr>

	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th>#</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Email</th>
				<th>Password</th>
				<th>Mobile</th>
				<th>Status</th>
				<th>Created On</th>
				<th>Modified On</th>

				<th colspan="2">Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($result as $row) : ?>
				<tr>
					<td><?php echo $row->customerId ?></td>
					<td><?php echo $row->firstName ?></td>
					<td><?php echo $row->lastName ?></td>
					<td><?php echo $row->email ?></td>
					<td><?php echo $row->password ?></td>
					<td><?php echo $row->mobile ?></td>
					<td><?php
						if ($row->status)
							echo "Enable";
						else
							echo "Disable";
						?>
					</td>
					<td><?php echo $row->createdDate ?></td>
					<td><?php echo $row->updatedDate ?></td>
					<td><a href="<?php echo $this->getUrl('form', NULL, ['id' => "$row->customerId"], TRUE); ?>"><i class="fas fa-pen"></i></a></td>
					<td><a href="<?php echo $this->getUrl('delete', NULL, ['id' => "$row->customerId"], TRUE); ?>"><i class="fas fa-trash-alt" style="color:tomato"></i></a></td>
				</tr>

			<?php endforeach; ?>
		</tbody>
	</table>
</div>