<?php

namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;
use \Framework\DW3ImagemUpload;

class Produto extends Modelo
{
    const BUSCAR_ID = 'SELECT id, id_categoria, nome, descricao, valor FROM produtos WHERE id = ?';
    const BUSCAR_PRODUTO = 'SELECT id, id_categoria, nome, descricao, valor FROM produtos';
    const BUSCAR_POR_CATEGORIA = 'SELECT id, id_categoria, nome, descricao, valor FROM produtos WHERE id_categoria = ? LIMIT 1';
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

    public function setNome($nome)
    {
        $this->nome = $nome;
    }


    public function getIdCategoria()
    {
        return $this->id_categoria;
    }

    public function setIdCategoria($id_categoria)
    {
        $this->id_categoria = $id_categoria;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    public function getValor()
    {
        return $this->valor;
    }

    public function setValor($valor)
    {
        $this->valor = $valor;
    }

    public function getImagem()
    {
        $imagemNome = "produto/{$this->id}.png";
        if (!DW3ImagemUpload::existe($imagemNome)) {
            $imagemNome = 'produto/padrao.png';
        }
        return $imagemNome;
    }


    public function verificarErros()
    { 
        if (strlen($this->nome) < 3) {
            $this->setErroMensagem('nome', 'O nome do produto deve ter no mínimo 3 caracteres.');
        }
        if (($this->id_categoria < 1) || ($this->id_categoria > 4)) {
            $this->setErroMensagem('id_categoria', 'Categoria nao existente, escolha uma das disponiveis.');
        }
        if (strlen($this->descricao) < 5) {
            $this->setErroMensagem('descricao', 'A Descrição Deve ter no mínimo 5 caracteres.');
        }
        if (($this->valor <= 0) || ($this->valor == null) || (!preg_match("/^[1-9]{1}([0-9]{1,3})?\.[0-9]{1,3}$/", $this->valor)) ) {
            $this->setErroMensagem('valor', 'O valor deve ser maior que 0.99 e menor que 999.999');
        }
        if (
            DW3ImagemUpload::existeUpload($this->foto)
            && !DW3ImagemUpload::isValida($this->foto)
        ) {
            $this->setErroMensagem('foto', 'Deve ser de no máximo 500 KB.');
        }



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
        $comando->bindValue(1, $id);
        $comando->execute();
        $registro = $comando->fetch();
        return new Produto(
            $registro['nome'],
            $registro['id_categoria'],
            $registro['descricao'],
            $registro['valor'],
            null,
            $registro['id']
        );
    }

    public static function buscarCategoria($id_categoria)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_POR_CATEGORIA);
        $comando->bindValue(1, $id_categoria, PDO::PARAM_STR);
        $comando->execute();
        $objeto = null;
        $registro = $comando->fetch();
        if ($registro) {
            $objeto = new Produto(
                $registro['nome'],
                $registro['id_categoria'],
                $registro['descricao'],
                $registro['valor'],
                null,
                $registro['id']
            );
        }
        return $objeto;
    }

    public static function buscarProdutos()
    {
        $registros = DW3BancoDeDados::query(self::BUSCAR_PRODUTO);
        $lista_produtos = [];
        foreach ($registros as $registro) {
            $lista_produtos[] = new Produto(
                $registro['nome'],
                $registro['id_categoria'],
                $registro['descricao'],
                $registro['valor'],
                null,
                $registro['id']

            );
        }
        return $lista_produtos;
    }
}
