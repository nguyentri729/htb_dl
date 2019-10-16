<div class="col-md-12">
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Thêm Package</h3>
	</div>
	<div class="panel-body">
				<form action="" method="POST" role="form">
			<div class="form-group">
				<label>* Tên Package: </label>
				<input type="text" class="form-control" placeholder="VIP" name="name_package" required="">
			</div>

			<div class="form-group">
				<label>* Miêu tả </label>
				<textarea class="form-control" placeholder="Miêu tả" name="mieu_ta" required=""></textarea>
			</div>
			<div class="form-group">
				<label>* Số lượng: </label>
				<input type="number" class="form-control" placeholder="Số lượng like(comment)" name="so_luong" required="">
			</div>

			<div class="form-group">
				<label>* Bài viết tối đa: </label>
				<input type="number" class="form-control" placeholder="Bài viết tối đa" name="max_post" required="" value="15">
			</div>

			<div class="form-group">
				<label>* Giá Clone /ngày: </label>
				<input type="number" class="form-control" placeholder="Giá cho Acc Clone" name="gia_clone" required="">
			</div>

			<div class="form-group">
				<label>* Giá người thật/ ngày: </label>
				<input type="number" class="form-control" placeholder="Giá người thật" name="gia_nguoithat" min="0" required="">
			</div>

			<div class="form-group">
				<label>* Đối tượng dùng: </label>
				<select name="doi_tuong_dung" class="form-control" required="required">
					<option value="1">Cộng tác viên</option>
					<option value="2">Đại lý</option>
				</select>
			</div>

			<div class="form-group">
				<label>* Mục thêm: </label>
				<select name="type_package" class="form-control" required="required">
					<option value="reactions">Reactions</option>
					<option value="comment">Comment</option>
				</select>
			</div>

			<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>">

				
			<div class="form-group">
				<button type="submit" class="btn btn-primary btn-block" id="submit_btn">Thêm package</button>
			</div>		
		</form>
	</div>
</div>
</div>
<div class="col-md-12">
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Danh sách Package</h3>
	</div>
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-hover" id="table_id">
				<thead>
					<tr>
						<th>#</th>
						<th>Tên Package</th>
						<th>Số lượng</th>
						<th>Max Posts</th>
						<th>Giá</th>
						<th>Đối tượng dùng</th>
						<th>Mục VIP</th>
						<th>Trạng thái</th>
						<th>Hành động</th>
					</tr>
				</thead>
				<tbody>
			 	<?php
			 	$i = 1;
			 	foreach ($data_package as $package): ?>
				<tr>
					<td><?=$i++?></td>
					<td><?=$package['name_package']?></td>
					<td><?=number_format($package['so_luong'])?></td>
					<td><?=$package['max_post']?></td>
					<td>
						<small>Nguời thật : <?=number_format($package['gia_nguoithat'])?></small><br>
						<small>Nguời clone : <?=number_format($package['gia_clone'])?></small>
					</td>
					<td>
						<?php
							if($package['doi_tuong_dung'] == 1){
								echo '<button class="btn btn-primary btn-xs">Cộng tác viên</button>';
							}else{
								echo '<button class="btn btn-info btn-xs">Đại lý</button>';
							}
						?>
					</td>
					<td>
						<?php
						switch ($package['type_package']) {
							case 'reactions':
								echo '<button class="btn btn-success btn-xs">Reactions</button>';
								break;
							case 'comment':
								echo '<button class="btn btn-info btn-xs">Comment</button>';
								break;
							default:
								echo '<button class="btn btn-danger btn-xs">Unknown</button>';
								break;
						}
						?>
					</td>
					<td>
						<?php
							if($package['active'] == 1){
								echo '<button class="btn btn-success btn-xs">Hoạt động</button>';
							}else{
								echo '<button class="btn btn-danger btn-xs">Tạm ngưng</button>';
							}
						?>
					</td>
					<td>
						<a href="?chinh_sua=<?=$package['id']?>" class="btn btn-xs btn-info">Sửa</a>
						<a href="#" onclick="delete_package(<?=$package['id']?>)" class="btn btn-xs btn-danger">Xóa</a>

					</td>
				</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
</div>


