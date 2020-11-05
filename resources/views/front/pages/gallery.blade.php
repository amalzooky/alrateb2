@extends('front.layouts.pages')
@section('content')
	<!-- breadcrumb -->
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="index.html">Home</a>
			</li>
			<li class="breadcrumb-item active" aria-current="page">Gallery</li>
		</ol>
	</nav>
	<!-- breadcrumb -->
	<!-- //banner -->

	<!-- gallery -->
	<section class="gallery py-5">
		<div class="container py-xl-5 py-lg-3">
			<h3 class="title text-capitalize font-weight-light text-dark text-center mb-5">our
				<span class="font-weight-bold">gallery</span>
			</h3>
			<div class="inner-sec pt-md-4">
				<div class="row proj_gallery_grid">
					<div class="col-sm-4 section_1_gallery_grid">
						<a href="images/ab.jpg">
							<div class="section_1_gallery_grid1">
								<img src="images/ab.jpg" alt=" " class="img-fluid" />
								<div class="proj_gallery_grid1_pos">
									<h3>Edulearn</h3>
									<p>Add some text here</p>
								</div>
							</div>
						</a>
					</div>
					<div class="col-sm-4 section_1_gallery_grid my-sm-0 my-4">
						<a href="images/n2.jpg">
							<div class="section_1_gallery_grid1">
								<img src="images/n2.jpg" alt=" " class="img-fluid" />
								<div class="proj_gallery_grid1_pos">
									<h3>Edulearn</h3>
									<p>Add some text here</p>
								</div>
							</div>
						</a>
					</div>
					<div class="col-sm-4 section_1_gallery_grid">
						<a href="images/n3.jpg">
							<div class="section_1_gallery_grid1">
								<img src="images/n3.jpg" alt=" " class="img-fluid" />
								<div class="proj_gallery_grid1_pos">
									<h3>Edulearn</h3>
									<p>Add some text here</p>
								</div>
							</div>
						</a>
					</div>
				</div>
				<div class="row proj_gallery_grid mt-4">
					<div class="col-sm-4 section_1_gallery_grid">
						<a href="images/am1.jpg">
							<div class="section_1_gallery_grid1">
								<img src="images/am1.jpg" alt=" " class="img-fluid" />
								<div class="proj_gallery_grid1_pos">
									<h3>Edulearn</h3>
									<p>Add some text here</p>
								</div>
							</div>
						</a>
					</div>
					<div class="col-sm-4 section_1_gallery_grid  my-sm-0 my-4">
						<a href="images/am2.jpg">
							<div class="section_1_gallery_grid1">
								<img src="images/am2.jpg" alt=" " class="img-fluid" />
								<div class="proj_gallery_grid1_pos">
									<h3>Edulearn</h3>
									<p>Add some text here</p>
								</div>
							</div>
						</a>
					</div>
					<div class="col-sm-4 section_1_gallery_grid">
						<a href="images/ap-2.jpg">
							<div class="section_1_gallery_grid1">
								<img src="images/ap-2.jpg" alt=" " class="img-fluid" />
								<div class="proj_gallery_grid1_pos">
									<h3>Edulearn</h3>
									<p>Add some text here</p>
								</div>
							</div>
						</a>
					</div>
				</div>
				<div class="row proj_gallery_grid mt-4">
					<div class="col-sm-4 section_1_gallery_grid">
						<a href="images/am4.jpg">
							<div class="section_1_gallery_grid1">
								<img src="images/am4.jpg" alt=" " class="img-fluid" />
								<div class="proj_gallery_grid1_pos">
									<h3>Edulearn</h3>
									<p>Add some text here</p>
								</div>
							</div>
						</a>
					</div>
					<div class="col-sm-4 section_1_gallery_grid  my-sm-0 my-4">
						<a href="images/n1.jpg">
							<div class="section_1_gallery_grid1">
								<img src="images/n1.jpg" alt=" " class="img-fluid" />
								<div class="proj_gallery_grid1_pos">
									<h3>Edulearn</h3>
									<p>Add some text here</p>
								</div>
							</div>
						</a>
					</div>
					<div class="col-sm-4 section_1_gallery_grid">
						<a href="images/am3.jpg">
							<div class="section_1_gallery_grid1">
								<img src="images/am3.jpg" alt=" " class="img-fluid" />
								<div class="proj_gallery_grid1_pos">
									<h3>Edulearn</h3>
									<p>Add some text here</p>
								</div>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--//gallery-->

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
