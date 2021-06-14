<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Forgot Password</h3>
			</div>
			<div class="card-body">
			<form action="<?php echo  $config['doc_root']; ?>sendMail" method="post">
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
			  <br>
			  <div class="form-row">
			  <button class="btn float-right" type="submit">Send</button>
			   </div>
			</form>
          </div>
		</div>
	</div>
</div>