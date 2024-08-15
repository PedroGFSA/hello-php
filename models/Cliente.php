<?php

class Cliente {
  private $nome;
  private $telefone;
  private $data_de_nascimento;
  private $email;
  private $cpf;

  public function __construct($nome, $telefone, $data_de_nascimento, $email, $cpf) 
  {
    $this->nome = $nome;
    $this->telefone = $telefone;
    $this->data_de_nasc = $data_de_nascimento;
    $this->email = $email;
    $this->cpf = $cpf;
  }

  public function __get($attribute) {
    return $this->$attribute;
  }

  public function __set($attribute, $value) {
    $this->$attribute = $value;
  }

  public function __toString()
  {
    return "CPF: $cpf | Nome: $nome | Telefone: $telefone | Data de nascimento: $data_de_nasc | Email: $email";
  }
}