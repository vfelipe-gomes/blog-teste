<?php

require '../conexao.php';
require '../src/Artigo.php';
require '../src/redireciona.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    
    $artigo = new Artigo($mysql);
    $artigo->editarArtigo($_POST['titulo'], $_POST['conteudo'], $_POST['id']);

    redireciona('/blog/admin/index.php');
}

$artigo = new Artigo($mysql);
$artigoEditavel = $artigo->exibirArtigoPorId($_GET['id']);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <link rel="stylesheet" type="text/css" href="../style.css">
    <meta charset="UTF-8">
    <title>Editar Artigo</title>
</head>

<body>
    <div id="container">
        <h1>Editar Artigo</h1>
        <form action="editar-artigo.php" method="post">
            <p>
                <label for="titulo">Digite o novo título do artigo</label>
                <input class="campo-form" type="text" name="titulo" id="titulo" value="<?php echo $artigoEditavel['titulo']; ?>" />
            </p>
            <p>
                <label for="conteudo">Digite o novo conteúdo do artigo</label>
                <textarea class="campo-form" type="text" name="conteudo" id="titulo"><?php echo $artigoEditavel['conteudo']; ?></textarea>
            </p>
            <p>
                <input type="hidden" name="id" value="<?php echo $artigoEditavel['id']; ?>" />
            </p>
            <p>
                <button class="botao">Editar Artigo</button>
            </p>
        </form>
    </div>
</body>

</html>