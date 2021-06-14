
<section class="intro">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12">
			<form action="<?php echo  $config['doc_root']; ?>user/signup" method="post">
			  <div class="form-row">
				<div class="col-12">
				  <label >Name</label>
				  <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
				  <div class="valid-feedback" style="display:none;">
					Looks good!
				  </div>
				</div>
			   </div>
			   <div class="form-row">
				<div class="col-12">
				  <label>Email</label>
				  <div class="input-group">
					<input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
					<div class="input-group-append">
					  <span class="input-group-text"><i class="fas fa-envelope"></i></span>
					</div>
				  </div>
				</div>
			  </div>
			  <div class="form-row">
				<div class="col-12">
				  <label>Password</label>
				  <div class="input-group">
					<input type="password" class="form-control" id="password" name="password" placeholder="password" required>
					<div class="input-group-append">
					  <span class="input-group-text"><i class="fas fa-key"></i></span>
					</div>
				  </div>
				</div>
			  </div>
			  <div class="form-row">
				<div class="col-12">
				  <label >Address</label>
				  <input type="text" class="form-control" id="address" name="address" placeholder="address"required>
				</div>
			  </div>
			  <br>
			  <div class="form-row">
			  <button class="btn float-right" type="submit">Sign Up</button>
			   </div>
			</form>
          </div>
        </div>
      </div>
</section>