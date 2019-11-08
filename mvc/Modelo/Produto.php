<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;
use \Framework\DW3ImagemUpload;

class Produto extends Modelo
{
    const BUSCAR_ID = 'SELECT * FROM produtos WHERE id = ?';
    const BUSCAR_POR_CATEGORIA = 'SELECT * FROM produtos WHERE id_categoria = ? LIMIT 1';
    const INSERIR = 'INSERT INTO produtos(nome,id_categoria,descricao,valor) VALUES (?, ?, ?, ?)';
    private $id;
    private $nome;
    private $id_categoria;
    private $descricao;
    private $valor;
    private $foto;

    public function __construct(
        $nome,
        $id_categoria,
        $descricao,
        $valor,
        $foto = null,
        $id = null
    ) {
        $this->id = $id;
        $this->nome = $nome;
        $this->id_categoria = $id_categoria;
        $this->descricao = $descricao;
        $this->valor = $valor;
        $this->foto = $foto;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getIdCategoria()
    {
        return $this->id_categoria;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function getValor()
    {
        return $this->valor;
    }

    public function getImagem()
    {
        $imagemNome = "{$this->id}.png";
        if (!DW3ImagemUpload::existe($imagemNome)) {
            $imagemNome = 'padrao.png';
        }
        return $imagemNome;
    }


    public function verificarErros()
    {   
       
    }

    public function salvar()
    {
        $this->inserir();
        $this->salvarImagem();
    }

    private function inserir()
    {
        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::INSERIR);
        $comando->bindValue(1, $this->nome, PDO::PARAM_STR);
        $comando->bindValue(2, $this->id_categoria, PDO::PARAM_STR);
        $comando->bindValue(3, $this->descricao, PDO::PARAM_STR);
        $comando->bindValue(4, $this->valor, PDO::PARAM_STR);
        $comando->execute();
        $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();
    }

    private function salvarImagem()
    {
        if (DW3ImagemUpload::isValida($this->foto)) {
            $nomeCompleto = PASTA_PUBLICO . "img/produto/{$this->id}.png";
            DW3ImagemUpload::salvar($this->foto, $nomeCompleto);
        }
    }

    public static function buscarId($id)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_ID);
        $comando->bindValue(1, $id, PDO::PARAM_INT);
        $comando->execute();
        $registro = $comando->fetch();
        return new Usuario(
            $registro['nome'],
            $registro['id_categoria'],
            $registro['descricao'],
            $registro['valor'],
            null,
            $registro['id']
        );
    }

    public static function buscarCategoria($nome_usuario)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_POR_CATEGORIA);
        $comando->bindValue(1, $id_categoria, PDO::PARAM_STR);
        $comando->execute();
        $objeto = null;
        $registro = $comando->fetch();
        if ($registro) {
            $objeto = new Usuario(
                $registro['nome'],
                $registro['id_categoria'],
                $registro['descricao'],
                $registro['valor'],
                null,
                $registro['id']
            );
            $objeto->senha = $registro['senha'];
        }
        return $objeto;
    }
}
