<?php

namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;
use \Framework\DW3ImagemUpload;

class Usuario extends Modelo
{
    const BUSCAR_ID = 'SELECT * FROM usuarios WHERE id = ?';
    const BUSCAR_NOME_USUARIO = 'SELECT * FROM usuarios WHERE nome_usuario = ? LIMIT 1';
    const INSERIR = 'INSERT INTO usuarios(nome, sobrenome, nome_usuario, email, senha, administrador) VALUES (?, ?, ?, ?, ?, ?)';
    private $id;
    private $nome;
    private $sobrenome;
    private $nome_usuario;
    private $email;
    private $senha;
    private $senhaPlana;
    private $administrador;
    private $foto;

    public function __construct(
        $nome,
        $sobrenome,
        $nome_usuario,
        $email,
        $senha,
        $administrador = 0,
        $foto = null,
        $id = null
    ) {
        $this->id = $id;
        $this->nome = $nome;
        $this->sobrenome = $sobrenome;
        $this->nome_usuario = $nome_usuario;
        $this->email = $email;
        $this->foto = $foto;
        $this->senhaPlana = $senha;
        $this->administrador = $administrador;
        $this->senha = password_hash($senha, PASSWORD_BCRYPT);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getSobrenome()
    {
        return $this->sobrenome;
    }

    public function getNomeUsuario()
    {
        return $this->nome_usuario;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function isAdmin()
    {
        return $this->administrador;
    }

    public function getImagem()
    {
        $imagemNome = "{$this->id}.png";
        if (!DW3ImagemUpload::existe($imagemNome)) {
            $imagemNome = 'padrao.png';
        }
        return $imagemNome;
    }

    public function verificarSenha($senhaPlana)
    {
        return password_verify($senhaPlana, $this->senha);
    }



    public function verificarErros()
    {
        if ((strlen($this->nome) < 2) || (!preg_match("/^[A-Za-z\s]+$/", $this->nome))) {
            $this->setErroMensagem('nome', 'deve ter no mínimo 3 letras e não pode possuir numeros e caracteres especiais.');
        }
        if ((strlen($this->sobrenome) < 3)  || (!preg_match("/^[A-Za-z]+$/", $this->sobrenome))) {
            $this->setErroMensagem('sobrenome', 'deve ter no mínimo 3 letras e não pode possuir numeros e caracteres especiais.');
        }
        if ((strlen($this->nome_usuario) < 6) || (!preg_match("/^[A-Za-z]+$/", $this->nome_usuario))) {
            $this->setErroMensagem('nome_usuario', 'deve ter no mínimo 6 caracteres e não pode possuir numeros e caracteres especiais.');
        }
        if (!preg_match("/^[^0-9][A-z0-9_]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_]+)*[.][A-z]{2,4}$/", $this->email)) {
            $this->setErroMensagem('email', 'O email deve conter um inicio, @dominio e um/ou mais .prefix');
        }
        if (strlen($this->senhaPlana) < 6) {
            $this->setErroMensagem('senha', 'Deve ter no mínimo 6 caracteres.');
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
        $comando->bindValue(1, $this->nome);
        $comando->bindValue(2, $this->sobrenome);
        $comando->bindValue(3, $this->nome_usuario);
        $comando->bindValue(4, $this->email);
        $comando->bindValue(5, $this->senha);
        $comando->bindValue(6, $this->administrador);
        $comando->execute();
        $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();
        
    }

    private function salvarImagem()
    {
        if (DW3ImagemUpload::isValida($this->foto)) {
            $nomeCompleto = PASTA_PUBLICO . "img/{$this->id}.png";
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
            $registro['sobrenome'],
            $registro['nome_usuario'],
            $registro['email'],
            '',
            $registro['administrador'],
            null,
            $registro['id']
        );
    }

    public static function buscarNomeUsuario($nome_usuario)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_NOME_USUARIO);
        $comando->bindValue(1, $nome_usuario, PDO::PARAM_STR);
        $comando->execute();
        $objeto = null;
        $registro = $comando->fetch();
        if ($registro) {
            $objeto = new Usuario(
                $registro['nome'],
                $registro['sobrenome'],
                $registro['nome_usuario'],
                $registro['email'],
                '',
                $registro['administrador'],
                null,
                $registro['id']
            );
            $objeto->senha = $registro['senha'];
        }
        return $objeto;
    }
}
