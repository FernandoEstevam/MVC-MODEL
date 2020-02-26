<?
/**
 * class ValidaDados
 * server para validar dados coletado via post ou get
 */

namespace Poupemais\Src\Core;
use Poupemais\Src\Core\{PasswordHash,Erro};

class ValidaDados extends PasswordHash
{

  # Valida os inputs
  protected function validaInput(string $post): string 
  { 
    if(!isset($post) || empty($post)) {
      Erro::setErro("Campo não informado!");      
    }

    return filter_var($post, FILTER_SANITIZE_SPECIAL_CHARS);
  }

  # Verifica se o POST esta vazio
  public static function verificaCampos($post) {
    $i = 0;

    foreach ($post as $key => $value) {
      if(empty($value)) {
        if($key !== 'complemento') {
          $i++;
        }
      }
    }
    if($i > 0) {
      Erro::setErro('Preencha todos os campos!');
    }
  }

  # Valida os email
  protected function validaEmail(string $post): string 
  { 
    if(!isset($post) || empty($post)) {
      Erro::setErro("Campo não informado!");      
    }

    return filter_var($post, FILTER_VALIDATE_EMAIL);
  }
  
  # Remove caractere
  public function removeCaracteres(string $variavel): string
  {
    $chars = array("(",")",".","-"," ",",");

    $variavel = str_replace($chars, "", $variavel);

    return $variavel;
  }

  # Valida quantidade de caracteres
  public function quantidadeChars(string $char, int $quantidade, string $msgErro, bool $espaco = true): string
  {
    if($espaco) {
      $char = $this->removeCaracteres($char);
    }

    if(strlen($char) < $quantidade) {
      Erro::setErro($msgErro);
    }

    return $char;
  }

  # Covnert para float
  public function convertNumber(string $number): float 
  {
    $number = str_replace(",","", $number);

    $number = floatval($number);

    return $number;
  }

  # Converte para int
  public function converInt(string $valor): int
  {
    $valor = substr($valor, 0,1);

    $valor = intval ($valor);

    return $valor;
  }
}
