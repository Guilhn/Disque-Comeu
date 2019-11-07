<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;
use \Framework\DW3ImagemUpload;

class Usuario extends Modelo
{
    const BUSCAR_POR_NOME_USUARIO = 'SELECT * FROM usuarios WHERE nome_usuario = ? LIMIT 1';
    const INSERIR = 'INSERT INTO usuarios(nome,sobrenome,nome_usuario,email,senha) VALUES (?, ?, ?, ?, ?)';
    private $id;
    private $nome;
    private $sobrenome;
    private $nome_usuario;
    private $email;
    private $senha;
    private $senhaPlana;
    private $foto;

    public function __construct(
        $nome,
        $sobrenome,
        $nome_usuario,
        $email,
        $senha,
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
        if (strlen($this->nome) < 2) {
            $this->setErroMensagem('nome', 'Deve ter no mínimo 2 caracteres');
        }
        if (strlen($this->sobrenome) < 3) {
            $this->setErroMensagem('sobrenome', 'Deve ter no mínimo 3 caracteres.');
        }
        if (strlen($this->nome_usuario) < 6) {
            $this->setErroMensagem('nome_usuario', 'Deve ter no mínimo 6 caracteres.');
        }
        if (!preg_match("/^[^0-9][A-z0-9_]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_]+)*[.][A-z]{2,4}$/" , $this->email)) {
           $this->setErroMensagem('email', 'O email deve conter um inicio, @dominio e um/ou mais .prefix');
        }
        if (strlen($this->senhaPlana) < 6) {
            $this->setErroMensagem('senha', 'Deve ter no mínimo 6 caracteres.');
        }
        if (DW3ImagemUpload::existeUpload($this->foto)
            && !DW3ImagemUpload::isValida($this->foto)) {
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
        $comando->bindValue(2, $this->sobrenome, PDO::PARAM_STR);
        $comando->bindValue(3, $this->nome_usuario, PDO::PARAM_STR);
        $comando->bindValue(4, $this->email, PDO::PARAM_STR);
        $comando->bindValue(5, $this->senha, PDO::PARAM_STR);
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

    public static function buscarNomeUsuario($nome_usuario)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_POR_NOME_USUARIO);
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
                null,
                $registro['id']
            );
            $objeto->senha = $registro['senha'];
        }
        return $objeto;
    }
}
