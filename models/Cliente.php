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
    $this->data_de_nascimento = $data_de_nascimento;
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
    return "CPF: $this->cpf | Nome: $this->nome | Telefone: $this->telefone | Data de nascimento: $this->data_de_nascimento | Email: $this->email";
  }
}