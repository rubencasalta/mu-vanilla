<?php
	/*
		Template Name: Layout 1
	*/
?>

<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<div class="container py-5">
		<h1 class="mb-3 text-center">Layout 1</h1>
		<p class="text-center">Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
		<hr class="mb-3">
		<div class="row">
			<div class="col-lg-9">
				<h2 class="mb-3">Listado de noticias</h2>
				<div class="row">
					<article class="col-md-6 mb-3">
						<h3 class="mb-2">Noticia 1</h3>
						<p class="m-0"><small><date>June 03, 2020</date></small></p>
						<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque recusandae alias aliquam necessitatibus id inventore consectetur delectus unde doloribus, nisi, quod iure, dolorem blanditiis voluptate fugiat? Dicta sint dolores accusamus!</p>
						<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita, et! Vel voluptas enim veniam velit. Suscipit obcaecati natus earum rem voluptas dignissimos hic aspernatur nobis, fugit, ipsa optio! Nisi, beatae.</p>
						<a href="#" class="btn btn-primary">sfsdfasdf</a>
					</article>
					<article class="col-md-6 mb-3">
						<h3 class="mb-2">Notícia 2</h3>
						<p class="m-0"><small><date>June 03, 2020</date></small></p>
						<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque recusandae alias aliquam necessitatibus id inventore consectetur delectus unde doloribus, nisi, quod iure, dolorem blanditiis voluptate fugiat? Dicta sint dolores accusamus!</p>
					</article>
					<article class="col-md-6 mb-3">
						<h3 class="mb-2">Notícia 3 con un título más largo</h3>
						<p class="m-0"><small><date>June 03, 2020</date></small></p>
						<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque recusandae alias aliquam necessitatibus id inventore consectetur delectus unde doloribus, nisi, quod iure, dolorem blanditiis voluptate fugiat? Dicta sint dolores accusamus!</p>
					</article>
					<article class="col-md-6 mb-3">
						<h3 class="mb-2">Notícia 4 con un título más largo que un día sin pan</h3>
						<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque recusandae alias aliquam necessitatibus id inventore consectetur delectus unde doloribus, nisi, quod iure, dolorem blanditiis voluptate fugiat? Dicta sint dolores accusamus!</p>
					</article>
				</div>
				<nav aria-label="Page navigation" class="my-3">
					<ul class="pagination pagination-md justify-content-center">
						<li class="page-item disabled">
							<a class="page-link" href="#" tabindex="-1">Previous</a>
						</li>
						<li class="page-item"><a class="page-link" href="#">1</a></li>
						<li class="page-item active">
							<a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
						</li>
						<li class="page-item"><a class="page-link" href="#">3</a></li>
						<li class="page-item">
							<a class="page-link" href="#">Next</a>
						</li>
					</ul>
				</nav>
			</div>
			<aside class="col-lg-3">
				<h2 class="mb-3">Secundaria</h2>
				<article class="mb-3">
					<h3>Sección 1</h3>
					<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti, tempore nulla odit asperiores corporis a saepe! Modi iste rem dolores nihil reprehenderit doloribus provident magnam, qui ipsam accusantium praesentium fuga.</p>
				</article>
				<article class="mb-3">
					<h3>Sección 2</h3>
					<p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
				</article>
				<article class="mb-3">
					<h3>Sección 3</h3>
					<p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
					<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt repellendus iste necessitatibus ratione aliquid aut possimus minima dignissimos! Inventore esse maiores minima qui voluptates optio ab aut fuga. Nihil, quo?</p>
				</article>
			</aside>
		</div>
	</div>

<?php endwhile; else : ?>

	<div class="container">
		<p class="text-danger"><?php get_template_part('template-parts/message', 'no-match') ?></p>
	</div>

<?php endif ?>

<?php get_footer(); ?>