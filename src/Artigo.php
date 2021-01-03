<?php

class Artigo
{

    private $mysql;

    public function __construct(mysqli $mysql)
    {
        $this->mysql = $mysql;    
            
    }

    public function exibirTodos(): array
    {
        $resultado = $this->mysql->query('SELECT id, titulo, conteudo FROM artigos');
        $artigos = $resultado->fetch_all(MYSQLI_ASSOC);
        
        return $artigos;
    }

    public function exibirArtigoPorId(string $id): array
    {
        $resultado = $this->mysql->prepare('SELECT id, titulo, conteudo FROM artigos WHERE id = ?');
        $resultado->bind_param('s', $id);
        $resultado->execute();
        $artigo = $resultado->get_result()->fetch_assoc();
        return $artigo;
    }

    public function adicionarArtigo(string $titulo, string $conteudo): void
    {
        $insercao = $this->mysql->prepare('INSERT INTO artigos (titulo, conteudo) VALUES (?,?)');
        $insercao->bind_param('ss', $titulo, $conteudo);
        $insercao->execute();
    }

    public function removerArtigo(string $id): void
    {
        $remocao = $this->mysql->prepare('DELETE FROM artigos WHERE id = ?');
        $remocao->bind_param('s', $id);
        $remocao->execute();
    }
    
    public function editarArtigo(string $titulo, string $conteudo, string $id): void
    {
        $edicao =  $this->mysql->prepare('UPDATE artigos SET titulo = ?, conteudo = ? WHERE id = ?');
        $edicao->bind_param('sss', $titulo, $conteudo, $id);
        $edicao->execute();
    }   
    
}

?>