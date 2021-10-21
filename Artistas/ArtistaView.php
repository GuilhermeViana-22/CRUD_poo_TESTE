<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/main.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <title>Teste Dev Php</title>
</head>
<?php
$params = $this->getParameter();
?>

<body>
    <main class="container">
        <h1>CADASTRO DE ARTISTAS</h1>

        <form method="POST" class="formulario" action="http://localhost/xampp/DevPhp/Artistas/Cadastro.php">
            <input type="text" name="name" id="name" class="input" placeholder="Nome do artista">
            <input type="text" name="country" id="country" class="input" placeholder="País do artista">
            <button type="submit">Enviar</button>
            <br>
            <?php
            echo $this->getMassage();
            ?>
        </form>
        <br>
        <br>
        <br>
        <label><strong>Listagem</strong></label>
        <br>
        <br>
        <br>

        <table cellspacing="1" cellpadding="1">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nome</th>
                    <th>Pais</th>
                    <th>Opções</th>

                </tr>
            </thead>
            <tbody>

                <?php
                foreach ($params as $param) {
                ?>
                    <tr>

                        <td><?php echo $param->getId() ?></td>
                        <td><?php echo $param->getName() ?></td>
                        <td><?php echo $param->getCountry() ?></td>

                        <td class="text-center"><a href="?method=RemoveArtista&id=<?php echo $param->getId() ?>" class="glyphicon glyphicon-remove">Remover</a></td>
                    </tr>
                <?php } ?>

            </tbody>
        </table>

        </table>
    </main>

</body>
<script>

</script>

</html>