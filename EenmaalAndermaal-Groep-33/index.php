<!DOCTYPE php>
<html lang="en">
  <head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width = device-width, initial-scale = 1">
	<title>Bootstrap Tutorial</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<style>
		.jumbotron{
			background-color:#2E2D88;
			color:white;
		}

		.tab-content {
			border-left: 1px solid #ddd;
			border-right: 1px solid #ddd;
			border-bottom: 1px solid #ddd;
			padding: 10px;
		}

		.nav-tabs {
			margin-bottom: 0;
		}
	</style>
  </head>
  <body>
		<div class="container">
			<div class="page-header">
				<h1>Bootstrap Tutorial</h1>
			</div>

			<div class="jumbotron">
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
				<p>
					<a href="#" class = "btn btn-default btn-lg" role="button">More info</a>
					<button type="submit" class = "btn btn-danger" role = "button">Button</button>
					<input type="button" value="Info" class = "btn btn-info">
					<button type="submit" class = "btn-primary btn-sm">Primary</button>
					<button type="submit" class = "btn btn-success btn-xs">Success</button>
					<button type="submit" class = "btn btn-warning btn-lg">Warning</button>
					<button type="submit" class = "btn btn-link btn-lg">Link</button>

					<button type="button" class="btn btn-lg btn-primary" disabled="disabled">Primary</button>

					<a href="#" class="btn btn-default btn-lg disabled" role="button">Link</a>

					<div class="btn-group btn-group-lg" role="group" aria-label="...">
					  <button type="button" class="btn btn-default">Small</button>
					  <button type="button" class="btn btn-default">Medium</button>
					  <button type="button" class="btn btn-default">Large</button>
					</div>
				</p>
			</div>
		</div>



	  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  </body>
</html>
