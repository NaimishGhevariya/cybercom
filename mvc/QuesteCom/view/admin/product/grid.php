<?php
$result = $this->getProducts();

?>
<div class="container">
	<h2 class="my-4">
		<?php echo $this->getTitle(); ?>
		<a class="btn btn-primary float-end" href="<?php echo $this->getUrlObject()->getUrl('form', 'product', NULL, TRUE); ?>"><i class="fas fa-plus"></i> Add</a>
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
				<th>Sku</th>
				<th>Product Name</th>
				<th>Price</th>
				<th>Discount</th>
				<th>Quantity</th>
				<th>Description</th>
				<th>Created On</th>
				<th>Modified On</th>
				<th>Status</th>
				<th colspan="3">Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($result as $row) : ?>
				<tr>
					<td><?php echo $row->productId ?></td>
					<td><?php echo $row->sku ?></td>
					<td><?php echo $row->name ?></td>
					<td><?php echo $row->price ?></td>
					<td><?php echo $row->discount ?></td>
					<td><?php echo $row->quantity ?></td>
					<td><?php echo $row->description ?></td>
					<td><?php echo $row->createdDate ?></td>
					<td><?php echo $row->updatedDate ?></td>

					<td><?php
						if ($row->status)
							echo "Enable";
						else
							echo "Disable";
						?>
					</td>

					<td><a href="<?php echo $this->getUrlObject()->getUrl('form', NULL, ['id' => "$row->productId"], TRUE); ?>"><i class="fas fa-pen"></i></a></td>
					<td><a href="<?php echo $this->getUrlObject()->getUrl('index', 'product\group\price', ['id' => "$row->productId"], TRUE); ?>"><i class="fas fa-hand-holding-usd"></i></a></td>
					<td><a href="<?php echo $this->getUrlObject()->getUrl('delete', NULL, ['id' => "$row->productId"], TRUE); ?>"><i class="fas fa-trash-alt" style="color:tomato"></i></a></td>
				</tr>

			<?php endforeach; ?>
		</tbody>
	</table>
</div>