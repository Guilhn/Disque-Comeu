<?php

namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;
use \Framework\DW3ImagemUpload;

class Produto extends Modelo
{
    const BUSCAR_ID = 'SELECT id, categoria_id, nome, descricao, valor FROM produtos WHERE id = ?';
    const BUSCAR_PRODUTOS = 'SELECT id, categoria_id, nome, descricao, valor FROM produtos WHERE TRUE';
    const BUSCAR_NOME_CATEGORIA = 'SELECT categoria FROM categorias WHERE id = ?';
    const INSERIR = 'INSERT INTO produtos(nome,categoria_id,descricao,valor) VALUES (?, ?, ?, ?)';
    const ATUALIZAR = 'UPDATE produtos SET categoria_id = ?, nome = ?, descricao = ?, valor = ?  WHERE id = ?';
    const CONTAR_TODOS = 'SELECT count(id) FROM produtos';
    const CONTAR_PRODUTOS_CATEGORIA = 'SELECT count(id) FROM produtos WHERE TRUE';

    private $id;
    private $nome;
    private $categoriaId;
    private $descricao;
    private $valor;
    private $foto;

    public function __construct(
        $nome,
        $categoriaId,
        $descricao,
        $valor,
        $foto = null,
        $id = null
    ) {
        $this->id = $id;
        $this->nome = $nome;
        $this->categoriaId = $categoriaId;
        $this->descricao = $descricao;
        $this->valor = $valor;
        $this->foto = $foto;
    }

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getCategoriaId()
    {
        return $this->categoriaId;
    }

    public function setCategoriaId($categoriaId)
    {
        $this->categoriaId = $categoriaId;
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
        if ((strlen($this->nome) < 3) || (!preg_match("/^[A-Za-z\s]+$/", $this->nome))) {
            $this->setErroMensagem('nome', 'deve ter no mínimo 3 letras e não pode possuir numeros e caracteres especiais.');
        }
        if (($this->categoriaId < 1) || ($this->categoriaId > 4)) {
            $this->setErroMensagem('categoria_id', 'Categoria nao existente, escolha uma das disponiveis.');
        }
        if (strlen($this->descricao) < 5) {
            $this->setErroMensagem('descricao', 'A Descrição Deve ter no mínimo 5 caracteres.');
        }
        if (($this->valor <= 0) || ($this->valor == null) || (!preg_match("/^[0-9]+$/", $this->valor)) ) {
            $this->setErroMensagem('valor', 'O valor deve ser um numero maior que 0, sem ponto e virgula!');
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
        if ($this->id == null) {
            $this->inserir();
            $this->salvarImagem();
        } else {
            $this->atualizar();
        }
        
    }

    private function inserir()
    {
        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::INSERIR);
        $comando->bindValue(1, $this->nome, PDO::PARAM_STR);
        $comando->bindValue(2, $this->categoriaId, PDO::PARAM_STR);
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

    public function atualizar()
    {
        $comando = DW3BancoDeDados::prepare(self::ATUALIZAR);
        $comando->bindValue(1, $this->categoriaId, PDO::PARAM_STR);
        $comando->bindValue(2, $this->nome, PDO::PARAM_STR);
        $comando->bindValue(3, $this->descricao, PDO::PARAM_STR);
        $comando->bindValue(4, $this->valor, PDO::PARAM_STR);
        $comando->bindValue(5, $this->id, PDO::PARAM_INT);
        $comando->execute();
    }

    public static function buscarId($id)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_ID);
        $comando->bindValue(1, $id);
        $comando->execute();
        $registro = $comando->fetch();
        return new Produto(
            $registro['nome'],
            $registro['categoria_id'],
            $registro['descricao'],
            $registro['valor'],
            null,
            $registro['id']
        );
    }

    public static function buscarNomeCategoria($categoriaId)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_NOME_CATEGORIA);
        $comando->bindValue(1, $categoriaId, PDO::PARAM_STR);
        $comando->execute();
        $objeto = null;
        $registro = $comando->fetch();
        if ($registro) {
            $objeto = $registro['categoria'];
        }
        return $objeto;
    }

    public static function buscarProdutos($filtro = [], $limit = 6, $offset = 0)
    {
        $sqlWhere = '';
        $parametro = '';
   
        if (array_key_exists('categoria_id', $filtro) && $filtro['categoria_id'] != '') {
            $parametro = $filtro['categoria_id'];
            $sqlWhere .= ' AND categoria_id = ?';
        }

        $sql = self::BUSCAR_PRODUTOS . $sqlWhere . ' LIMIT ? OFFSET ?';

        $comando = DW3BancoDeDados::prepare($sql);
        $parametroNumero = 1;
        if ($parametro != '') {
            $comando->bindValue($parametroNumero, $parametro, PDO::PARAM_INT);
            $parametroNumero++;
        }
        $comando->bindValue($parametroNumero, $limit, PDO::PARAM_INT);
        $comando->bindValue($parametroNumero + 1, $offset, PDO::PARAM_INT);
        $comando->execute();
        $registros = $comando->fetchAll();
        $listaProdutos = [];
        foreach ($registros as $registro) {
            $listaProdutos[] = new Produto(
                $registro['nome'],
                $registro['categoria_id'],
                $registro['descricao'],
                $registro['valor'],
                null,
                $registro['id']

            );
        }
        return $listaProdutos;
    }

    public static function contarTodos()
    {
        $registros = DW3BancoDeDados::query(self::CONTAR_TODOS);
        $total = $registros->fetch();
        return intval($total[0]);
    }

    public static function contarProdutosCategoria($id)
    {
        $sqlWhere = '';

        if ($id != null) {
            $sqlWhere .= ' AND categoria_id = ?';
        }

        $sql = self::CONTAR_PRODUTOS_CATEGORIA . $sqlWhere;
        $comando = DW3BancoDeDados::prepare($sql);
        $parametroNumero = 1;
        if ($id != null) {
            $comando->bindValue($parametroNumero, $id);
            $parametroNumero++;
        }
        $comando->execute();
        
        $total = $comando->fetch();
        
        return intval($total[0]);

        
    }
}
