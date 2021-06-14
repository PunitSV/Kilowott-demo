
function login(){
	$.post(
	"http://localhost/login/authenticate/",
	  {
		email: $('#email').val(),
		password: $('#password').val()
	  },
	  function(data, status){
		  var data = JSON.parse(data);
		 if(data['status_code'] == 200){
			 window.location.href = 'http://localhost/dashboard/';
		 }
		 else{
			 alert(data.msg);
		 }
	  });
}

function deleteUser(id){
	
	var r = confirm("Do you really want to delete?");
	 if (r == true) {
		$.post(
		"http://localhost/user/delete/",
		  {
			id: id
		  },
		  function(data, status){
			  var data = JSON.parse(data);
			 if(data['status_code'] == 200){
				window.location.href = 'http://localhost/dashboard/';
			 }
			 else{
				 alert(data.msg);
			 }
		  });
	  } 
	
}