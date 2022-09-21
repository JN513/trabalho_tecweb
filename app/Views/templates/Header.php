<!DOCTYPE html>
<html lang="pt-BR">

<head>
	<meta charset="UTF-8" />
	<title>Ludwig Von Mises</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<style>
		* {
			margin: 0;
			padding: 0;
		}

		body {
			background-color: PowderBlue;
		}
	</style>
</head>

<body>
	<div class="container-fluid bg-dark py-3 px-4">
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<a class="navbar-brand" href="/">Ludwig Von Mises</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
				<div class="navbar-nav">
					<a class="nav-item nav-link" href="/">Home</span></a>
					<?php if (session()->get('isLoggedIn')) : ?>
						<a class="nav-item nav-link" href="/profile">perfil</a>
						<a class="nav-item nav-link" href="/logout">Logout</a>
						<?php if (session()->get('is_staff')) : ?>
							<a class="nav-item nav-link" href="/create">Criar Conteudo</a>
						<?php endif; ?>
					<?php else : ?>
						<a class="nav-item nav-link" href="/login">Login</a>
						<a class="nav-item nav-link" href="/cadastro">Cadastro</a>
					<?php endif; ?>
				</div>
			</div>
		</nav>
	</div>