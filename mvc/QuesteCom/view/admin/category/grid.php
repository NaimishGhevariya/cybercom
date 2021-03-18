<?php
$result = $this->getCategories();
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
	<table class="table table-striped ">
		<thead class="thead-inverse">
			<tr>
				<th>#</th>
				<th>Category</th>
				<th>Description</th>
				<th>Parent ID</th>
				<th>Path</th>
				<th>Status</th>
				<th>Featured</th>
				<th colspan="2">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($result as $row) : ?>
				<tr>
					<td><?php echo $row->categoryId; ?></td>
					<td><?php echo $this->getName($row); ?></td>
					<td><?php echo $row->description; ?></td>
					<td><?php echo $row->parentId; ?></td>
					<td><?php echo $row->path; ?></td>
					<td>
						<?php if ($row->status) : echo "Enable"; ?>
						<?php else : echo "Disable"; ?>
						<?php endif; ?>
					</td>
					<td>
						<?php if ($row->featured) : echo "Yes"; ?>
						<?php else : echo "No"; ?>
						<?php endif; ?>
					</td>
					<td><a href="<?php echo $this->getUrl('form', NULL, ['id' => "$row->categoryId"], TRUE); ?>"><i class="fas fa-pencil" aria-hidden="true"></i></a></td>
					<td><a href="<?php echo $this->getUrl('delete', NULL, ['id' => "$row->categoryId"], TRUE); ?>"><i class="fas fa-trash-alt" aria-hidden="true" style="color: tomato;"></i></a></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>