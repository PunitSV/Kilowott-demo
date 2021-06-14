
<section class="intro">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12">
			<form action="<?php echo  $config['doc_root']; ?>user/save" method="post">
			  <div class="form-row">
				<div class="col-12">
				  <label >Name</label>
				  <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="<?php echo $data['name']; ?>" required>
				  <div class="valid-feedback" style="display:none;">
					Looks good!
				  </div>
				</div>
			   </div>
			   <div class="form-row">
				<div class="col-12">
				  <label>Email</label>
				  <div class="input-group">
					<input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $data['email']; ?>" aria-describedby="inputGroupPrepend3" required>
					<div class="input-group-append">
					  <span class="input-group-text"><i class="fas fa-envelope"></i></span>
					</div>
				  </div>
				</div>
			  </div>
			  <div class="form-row">
				<div class="col-12">
				  <label >Address</label>
				  <input type="text" class="form-control" id="address" name="address" placeholder="address" value="<?php echo $data['address']; ?>"required>
				</div>
			  </div>
			  <div class="form-row">
				<div class="col-12">
					 <label >Role</label>
					<select name="role" class="custom-select" required>
					  <option value="1">Admin</option>
					  <option value="2">User</option>
					</select>
				</div>
			  </div>
			  <br>
			  <div class="form-row">
			  <input type= "hidden" name="id" value="<?php echo $data['id']; ?>" />
			  <button class="btn float-right" type="submit">Save</button>
			   </div>
			</form>
          </div>
        </div>
      </div>
</section>