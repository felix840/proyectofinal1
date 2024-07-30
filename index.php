<!DOCTYPE HTML>
<html>
	<head>
		<title>Biblioteca</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="is-preload">

		<!-- Header -->
		<div id="header">

			<div class="top">

				<!-- Logo -->
				<div id="logo">
					<span class="image avatar48"><img src="images/avatar.jpg" alt="" /></span>
					<h1 id="title">La biblioteca</h1>
					<p>Encuentra tus libros favoritos</p>
				</div>

				<!-- Nav -->
				<nav id="nav">
					<ul>
						<li><a href="#inicio" id="inicio-link"><span class="icon solid fa-home">Inicio</span></a></li>
						<li><a href="#libros" id="libros-link"><span class="icon solid fa-book">Libros</span></a></li>
						<li><a href="#autores" id="autores-link"><span class="icon solid fa-user">Autores</span></a></li>
						<li><a href="#contacto" id="contacto-link"><span class="icon solid fa-envelope">Contacto</span></a></li>
					</ul>
				</nav>

			</div>

			<div class="bottom">
				<!-- Social Icons -->
				<ul class="icons">
					<li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
					<li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
					<li><a href="#" class="icon brands fa-github"><span class="label">Github</span></a></li>
					<li><a href="#" class="icon brands fa-dribbble"><span class="label">Dribbble</span></a></li>
					<li><a href="#" class="icon solid fa-envelope"><span class="label">Email</span></a></li>
				</ul>
			</div>

		</div>

		<!-- Main -->
		<div id="main">

			<!-- Inicio -->
			<section id="inicio" class="one dark cover">
				<div class="container">
					<header>
						<h2 class="alt">Bienvenido a <strong>Biblioteca</strong></h2>
						<p>Encuentra y descubre tus libros favoritos.</p>
					</header>
					<footer>
						<a href="#libros" class="button scrolly">Ver Libros</a>
					</footer>
				</div>
			</section>

			<!-- Libros -->
			<section id="libros" class="two">
				<div class="container">
					<header>
						<h2>Libros</h2>
					</header>
					<p>Lista de libros disponibles en nuestra biblioteca:</p>
					<table>
						<tr>
							<th>Titulos</th>
							<th>Tipo</th>
							<th>Ventas</th>
						</tr>
						<?php
						include 'config.php';
						$stmt = $conn->prepare("SELECT titulo, tipo, total_ventas FROM titulos");
						$stmt->execute();
						$titulos = $stmt->fetchAll(PDO::FETCH_ASSOC);
						foreach ($titulos as $titulo): ?>
						<tr>
							<td><?php echo htmlspecialchars($titulo['titulo']); ?></td>
							<td><?php echo htmlspecialchars($titulo['tipo']); ?></td>
							<td><?php echo htmlspecialchars($titulo['total_ventas']); ?></td>
						</tr>
						<?php endforeach; ?>
					</table>
				</div>
			</section>

			<!-- Autores -->
		<section id="autores" class="three">
    <div class="container">
        <header>
            <h2>Autores</h2>
        </header>
        <p>Lista de autores disponibles en nuestra biblioteca:</p>
        <table>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Ciudad</th>
            </tr>
            <?php
            include 'config.php';
            $stmt = $conn->prepare("SELECT nombre, apellido, ciudad FROM autores");
            $stmt->execute();
            $autores = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($autores as $autor): ?>
            <tr>
                <td><?php echo htmlspecialchars($autor['nombre']); ?></td>
                <td><?php echo htmlspecialchars($autor['apellido']); ?></td>
                <td><?php echo htmlspecialchars($autor['ciudad']); ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</section>


			<!-- Contacto -->
			<section id="contacto" class="four">
    <div class="container">
        <header>
            <h2>Contacto</h2>
        </header>
        <p>Envíanos tus comentarios y sugerencias.</p>
        <form id="contact-form" method="post">
            <div class="row">
                <div class="col-6 col-12-mobile">
                    <input type="text" name="nombre" placeholder="Nombre" required />
                </div>
                <div class="col-6 col-12-mobile">
                    <input type="email" name="correo" placeholder="Correo" required />
                </div>
                <div class="col-12">
                    <input type="text" name="asunto" placeholder="Asunto" required />
                </div>
                <div class="col-12">
                    <textarea name="comentario" placeholder="Comentario" required></textarea>
                </div>
                <div class="col-12">
                    <input type="submit" value="Enviar Mensaje" />
                </div>
            </div>
        </form>
        <div id="response-message"></div> <!-- Para mostrar mensajes -->
    </div>


	<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contact-form');
    const responseMessage = document.getElementById('response-message');

    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Evita el envío normal del formulario

        const formData = new FormData(form);

        fetch('procesar_contacto.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(result => {
            responseMessage.innerHTML = result; // Muestra el comentario formateado
            form.reset(); // Limpia el formulario
        })
        .catch(error => {
            responseMessage.innerHTML = 'Error al enviar el mensaje. Por favor, inténtalo de nuevo.';
            console.error('Error:', error);
        });
    });
});
</script>


<style>
	.comment-box {
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 15px;
    margin-top: 20px;
    background-color: #f9f9f9;
}

.comment-box p {
    margin: 5px 0;
}

.comment-box p strong {
    color: #333;
}

</style>



</section>




		<!-- Scripts -->
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/jquery.scrolly.min.js"></script>
		<script src="assets/js/jquery.scrollex.min.js"></script>
		<script src="assets/js/browser.min.js"></script>
		<script src="assets/js/breakpoints.min.js"></script>
		<script src="assets/js/util.js"></script>
		<script src="assets/js/main.js"></script>

	</body>
</html>
