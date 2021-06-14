<section class="intro">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12">
			<button type="button" class="btn float-right" onclick="window.location.href='<?php echo  $config['doc_root']; ?>user/add'"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>
		   </div>
		  <div class="col-12">
            <div class="table-responsive">
              <table class="table table-dark table-bordered">
                <thead style="position: sticky;top: 0" class="thead-dark">
                  <tr>
                    <th class="sticky-header" scope="col">Name</th>
                    <th class="sticky-header" scope="col">Email</th>
                    <th class="sticky-header" scope="col">Address</th>
                    <th class="sticky-header" scope="col">Created Date</th>
                    <th class="sticky-header" scope="col">Role</th>
                    <th class="sticky-header" scope="col"></th>
                  </tr>
                </thead>
                <tbody>
				<?php 
					foreach($data AS $val)
					{
					?>
                  <tr class="pointer">
                    <th  onclick="window.location.href='<?php echo  $config['doc_root']; ?>user/<?php echo  $val['id']; ?>'" scope="row"><?php echo $val['name']; ?></th>
                    <td  onclick="window.location.href='<?php echo  $config['doc_root']; ?>user/<?php echo  $val['id']; ?>'"><?php echo $val['email']; ?></td>
                    <td  onclick="window.location.href='<?php echo  $config['doc_root']; ?>user/<?php echo  $val['id']; ?>'"><?php echo $val['address']; ?></td>
                    <td  onclick="window.location.href='<?php echo  $config['doc_root']; ?>user/<?php echo  $val['id']; ?>'"><?php $date=date_create(val['created_date']); echo date_format($date,"d-m-Y"); ?></td>
                    <td  onclick="window.location.href='<?php echo  $config['doc_root']; ?>user/<?php echo  $val['id']; ?>'"><?php 
							if($val['role'] == 1)
								$role = 'Admin';
							else if($val['role'] == 2)
								$role = 'User';
							echo $role; 
							?></td>
					<td onclick="deleteUser(<?php echo  $val['id']; ?>);";>
						<i class="fa fa-trash red" aria-hidden="true"></i>

					</td>
                  </tr>
					<?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
</section>