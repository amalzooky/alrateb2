@extends('front.layouts.pages')
@section('content')
<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="index.html">Home</a>
			</li>
			<li class="breadcrumb-item active" aria-current="page">Blog Page</li>
		</ol>
	</nav>
	<!-- breadcrumb -->
	<!-- //banner -->

	<!-- blog -->
	<div class="blog-w3l py-5">
		<div class="container py-xl-5 py-lg-3">
			<h3 class="title text-capitalize font-weight-light text-dark text-center mb-5">blog
				<span class="font-weight-bold">page</span>
			</h3>
			<div class="row blog-content pt-md-4">
				<!-- left side -->
				<div class="col-lg-8 blog_section">
					<div class="card">
						<img class="card-img-top" src="images/banner2.jpg" alt="">
						<div class="card-body text-center">
							<h6 class="blog-first text-dark">
								<i class="far fa-user mr-2"></i>Adrian Lie
							</h6>
							<ul class="blog_list my-3">
								<li>May 15, 2018</li>
								<li class="mx-3">
									<a href="#">
										<i class="far fa-heart mr-1"></i>
										30</a>
								</li>
								<li>
									<a href="#">
										<i class="far fa-comments mr-1"></i>
										18</a>
								</li>
							</ul>
							<h5 class="card-title">
								<a href="single.html" class="text-dark">Blog title here</a>
							</h5>
							<p class="card-text">Morbi eget dui elit. In lectus eros, convallis vel dolor vitae, semper sodales risus. Donec convallis maximus neque
								vel cursus.</p>
							<a href="single.html" class="btn btn-primary blog-button mt-3">Read More</a>
						</div>
					</div>
					<div class="card my-4">
						<img class="card-img-top" src="images/banner3.jpg" alt="">
						<div class="card-body text-center">
							<h6 class="blog-first text-dark">
								<i class="far fa-user mr-2"></i>James Doe
							</h6>
							<ul class="blog_list my-3">
								<li>May 22, 2018</li>
								<li class="mx-3">
									<a href="#">
										<i class="far fa-heart mr-1"></i>
										28</a>
								</li>
								<li>
									<a href="#">
										<i class="far fa-comments mr-1"></i>
										12</a>
								</li>
							</ul>
							<h5 class="card-title">
								<a href="single.html" class="text-dark">Blog title here</a>
							</h5>
							<p class="card-text">Morbi eget dui elit. In lectus eros, convallis vel dolor vitae, semper sodales risus. Donec convallis maximus neque
								vel cursus.</p>
							<a href="single.html" class="btn btn-primary blog-button mt-3">Read More</a>
						</div>
					</div>
					<div class="card my-4">
						<img class="card-img-top" src="images/banner4.jpg" alt="">
						<div class="card-body text-center">
							<h6 class="blog-first text-dark">
								<i class="far fa-user mr-2"></i>Jenny Joy
							</h6>
							<ul class="blog_list my-3">
								<li>June 02, 2018</li>
								<li class="mx-3">
									<a href="#">
										<i class="far fa-heart mr-1"></i>
										22</a>
								</li>
								<li>
									<a href="#">
										<i class="far fa-comments mr-1"></i>
										16</a>
								</li>
							</ul>
							<h5 class="card-title">
								<a href="single.html" class="text-dark">Blog title here</a>
							</h5>
							<p class="card-text">Morbi eget dui elit. In lectus eros, convallis vel dolor vitae, semper sodales risus. Donec convallis maximus neque
								vel cursus.</p>
							<a href="single.html" class="btn btn-primary blog-button mt-3">Read More</a>
						</div>
					</div>
					<nav aria-label="Page navigation example">
						<ul class="pagination mt-5">
							<li class="page-item disabled">
								<a class="page-link" href="#" tabindex="-1">Previous</a>
							</li>
							<li class="page-item">
								<a class="page-link" href="#">1</a>
							</li>
							<li class="page-item">
								<a class="page-link" href="#">2</a>
							</li>
							<li class="page-item">
								<a class="page-link" href="#">3</a>
							</li>
							<li class="page-item">
								<a class="page-link" href="#">Next</a>
							</li>
						</ul>
					</nav>
					<!-- //left side -->
				</div>
				<!-- right side -->
				<div class="col-lg-4 event-right mt-lg-0 mt-sm-5 mt-4">
					<div class="event-right1">
						<div class="search1">
							<form class="form-inline" action="#" method="post">
								<input class="form-control rounded-0 mr-sm-2" type="search" placeholder="Search Here" aria-label="Search" required>
								<button class="btn bg-dark text-white rounded-0 mt-3" type="submit">Search</button>
							</form>
						</div>
						<div class="categories my-4 p-4 border">
							<h3 class="blog-title text-dark">Categories</h3>
							<ul>
								<li class="mt-3">
									<i class="fas fa-check mr-2"></i>
									<a href="single.html">At vero eos et accusamus iusto</a>
								</li>
								<li class="mt-3">
									<i class="fas fa-check mr-2"></i>
									<a href="single.html">Sed ut perspiciatis unde omnis</a>
								</li>
								<li class="mt-3">
									<i class="fas fa-check mr-2"></i>
									<a href="single.html">Accusantium doloremque lauda</a>
								</li>
								<li class="mt-3">
									<i class="fas fa-check mr-2"></i>
									<a href="single.html">Vel illum qui dolorem fugiat quo</a>
								</li>
								<li class="mt-3">
									<i class="fas fa-check mr-2"></i>
									<a href="single.html">Quis autem vel eum repreh</a>
								</li>
								<li class="mt-3">
									<i class="fas fa-check mr-2"></i>
									<a href="single.html">Neque porro quisquam est qui</a>
								</li>
							</ul>
						</div>
						<div class="posts p-4 border">
							<h3 class="blog-title text-dark">Our Events</h3>
							<div class="posts-grids">
								<div class="row posts-grid mt-4">
									<div class="col-lg-4 col-md-3 col-4 posts-grid-left pr-0">
										<a href="single.html">
											<img src="images/c1.jpg" alt=" " class="img-fluid" />
										</a>
									</div>
									<div class="col-lg-8 col-md-7 col-8 posts-grid-right mt-lg-0 mt-md-5 mt-sm-4">
										<h4>
											<a href="single.html" class="text-dark">Sed ut perspiciatis unde omni</a>
										</h4>
										<ul class="wthree_blog_events_list mt-2">
											<li class="mr-2 text-dark">
												<i class="fa fa-calendar mr-2" aria-hidden="true"></i>15/05/18</li>
											<li>
												<i class="fa fa-user" aria-hidden="true"></i>
												<a href="single.html" class="text-dark ml-2">Admin</a>
											</li>
										</ul>
									</div>
								</div>
								<div class="row posts-grid mt-4">
									<div class="col-lg-4 col-md-3 col-4 posts-grid-left pr-0">
										<a href="single.html">
											<img src="images/c2.jpg" alt=" " class="img-fluid" />
										</a>
									</div>
									<div class="col-lg-8 col-md-7 col-8 posts-grid-right mt-lg-0 mt-md-5 mt-sm-4">
										<h4>
											<a href="single.html" class="text-dark">Sed ut perspiciatis unde omni</a>
										</h4>
										<ul class="wthree_blog_events_list mt-2">
											<li class="mr-2 text-dark">
												<i class="fa fa-calendar mr-2" aria-hidden="true"></i>23/05/18</li>
											<li>
												<i class="fa fa-user" aria-hidden="true"></i>
												<a href="single.html" class="text-dark ml-2">Admin</a>
											</li>
										</ul>
									</div>
								</div>
								<div class="row posts-grid mt-4">
									<div class="col-lg-4 col-md-3 col-4 posts-grid-left pr-0">
										<a href="single.html">
											<img src="images/c3.jpg" alt=" " class="img-fluid" />
										</a>
									</div>
									<div class="col-lg-8 col-md-7 col-8 posts-grid-right mt-lg-0 mt-md-5 mt-sm-4">
										<h4>
											<a href="single.html" class="text-dark">Sed ut perspiciatis unde omni</a>
										</h4>
										<ul class="wthree_blog_events_list mt-2">
											<li class="mr-2 text-dark">
												<i class="fa fa-calendar mr-2" aria-hidden="true"></i>13/06/18</li>
											<li>
												<i class="fa fa-user" aria-hidden="true"></i>
												<a href="single.html" class="text-dark ml-2">Admin</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="tags mt-4 p-4 border">
							<h3 class="blog-title text-dark">Recent Tags</h3>
							<ul class="mt-4">
								<li>
									<a href="single.html" class="text-dark border">Designs</a>
								</li>
								<li>
									<a href="single.html" class="text-dark border">Growth</a>
								</li>
								<li>
									<a href="single.html" class="text-dark border">Latest</a>
								</li>
								<li>
									<a href="single.html" class="text-dark border">Price</a>
								</li>
								<li>
									<a href="single.html" class="text-dark border">Tools</a>
								</li>
								<li>
									<a href="single.html" class="text-dark border">Business</a>
								</li>
								<li>
									<a href="single.html" class="text-dark border">Work Space</a>
								</li>
								<li>
									<a href="single.html" class="text-dark border">New Course</a>
								</li>
								<li>
									<a href="single.html" class="text-dark border">Advantage</a>
								</li>
								<li>
									<a href="single.html" class="text-dark border">Concepts</a>
								</li>
								<li>
									<a href="single.html" class="text-dark border">Arts</a>
								</li>
								<li>
									<a href="single.html" class="text-dark border">Photography</a>
								</li>
								<li>
									<a href="single.html" class="text-dark border">Research</a>
								</li>
								<li>
									<a href="single.html" class="text-dark border">Software</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- //right side -->
			</div>
		</div>
	</div>
	<!-- //blog -->

	<!-- brands -->
	<div class="brands-w3ls py-md-5 py-4">
		<div class="container py-xl-3">
			<ul class="list-unstyled">
				<li>
					<i class="fab fa-supple"></i>
				</li>
				<li>
					<i class="fab fa-angrycreative"></i>
				</li>
				<li>
					<i class="fab fa-aviato"></i>
				</li>
				<li>
					<i class="fab fa-aws"></i>
				</li>
				<li>
					<i class="fab fa-cpanel"></i>
				</li>
				<li>
					<i class="fab fa-hooli"></i>
				</li>
				<li>
					<i class="fab fa-node"></i>
				</li>
			</ul>
		</div>
	</div>
	<!-- //brands -->

@endsection
