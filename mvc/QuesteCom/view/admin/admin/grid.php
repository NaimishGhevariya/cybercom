<?php
$result = $this->getAdmins();
?>
<div class="container">
	<h2 class="my-4">
		<?php echo $this->getTitle(); ?>
		<a class="btn btn-primary float-end" href="<?php echo $this->getUrlObject()->getUrl('form', NULL, TRUE); ?>"><i class="fas fa-plus"></i> Add</a>
	</h2>
	<hr>
	<h4><?php if (!$result) {
			echo "No Record Found";
			die();
		} ?></h4>

	<table class="table table-striped table-inverse table-responsive">
		<thead class="thead-inverse">
			<tr>
				<th>#</th>
				<th>Username</th>
				<th>Email Id</th>
				<th>Password</th>
				<th>Status</th>
				<th>Created On</th>
				<th>Modified On</th>
				<th colspan="2">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($result as $row) { ?>
				<tr>
					<td><?php echo $row->adminId; ?></td>
					<td><?php echo $row->username; ?></td>
					<td><?php echo $row->emailId; ?></td>
					<td><?php echo $row->password; ?></td>
					<td><?php
						if ($row->status)
							echo "Enable";
						else
							echo "Disable";
						?>
					<td><?php echo $row->createdDate ?></td>
					<td><?php echo $row->updatedDate ?></td>
					</td>
					<td><a href="<?php echo $this->getUrl('form', NULL, ['id' => "$row->adminId"], TRUE); ?>"><i class="fas fa-pencil" aria-hidden="true"></i></a></td>
					<td><a href="<?php echo $this->getUrl('delete', NULL, ['id' => "$row->adminId"], TRUE); ?>"><i class="fas fa-trash-alt" aria-hidden="true" style="color:tomato"></i></a></td>
				</tr>

			<?php
			}
			?>
		</tbody>
	</table>
</div>