<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Xin Chào</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<!-- <link rel="icon" href="logo.png"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body class="body-home">
    <div class="black-fill"><br /> <br />
    	<div class="container">
    	<nav class="navbar navbar-expand-lg bg-light"
    	     id="homeNav">
		  <div class="container-fluid">
		    <!-- <a class="navbar-brand" href="#">
		    	<img src="logo.png" width="40">
		    </a> -->
		    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		      <span class="navbar-toggler-icon"></span>
		    </button>
		    <div class="collapse navbar-collapse" id="navbarSupportedContent">
		      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
		        <li class="nav-item">
		          <a class="nav-link active" aria-current="page" href="#">Trang chủ</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link" href="#about">Về chúng tôi</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link" href="#contact">Liên hệ</a>
		        </li>
		      </ul>
		      <ul class="navbar-nav me-right mb-2 mb-lg-0">
		      	<li class="nav-item">
		          <a class="nav-link" href="login.php">Đăng nhập</a>
		        </li>
		      </ul>
		  </div>
		    </div>
		</nav>
        <section class="welcome-text d-flex justify-content-center align-items-center flex-column">
        	<!-- <img src="logo.png" > -->
        	<h4>Chào mừng đến với T school</h4>
        </section>
        <section id="about"
                 class="d-flex justify-content-center align-items-center flex-column">
        	<div class="card mb-3 card-1">
			  <div class="row g-0">
			    <!-- <div class="col-md-4">
			      <img src="logo.png" class="img-fluid rounded-start" >
			    </div> -->
			    <div class="col-md-8">
			      <div class="card-body">
			        <h5 class="card-title">Về chúng tôi</h5>
			        <p class="card-text">T school </p>
			        <p class="card-text"><small class="text-muted">T School</small></p>
			      </div>
			    </div>
			  </div>
			</div>
        </section>
        <section id="contact"
                 class="d-flex justify-content-center align-items-center flex-column">
        	<form>
        		<h3>Liên hệ chúng tôi</h3>
			  <div class="mb-3">
			    <label for="exampleInputEmail1" class="form-label">Địa chỉ email</label>
			    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
			    <div id="emailHelp" class="form-text">Chúng tôi sẽ không bao giờ chia sẻ email của bạn với bất kỳ ai khác.</div>
			  </div>
			  <div class="mb-3">
			    <label class="form-label">Tên</label>
			    <input type="text" class="form-control">
			  </div>
			  <div class="mb-3">
			    <label class="form-label">Nội dung</label>
			    <textarea class="form-control" rows="4"></textarea>
			  </div>
			  <button type="submit" class="btn btn-primary">Gửi</button>
			</form>
        </section>
        <div class="text-center text-light">
        	<!-- Copyright &copy; 2024 Y School. All rights reserved. -->
        </div>

    	</div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>	
</body>
</html>