# D4Sign Laravel Client - SDK

SDK Não oficial de integração á API do serviço [D4Sign REST API](http://docapi.d4sign.com.br/).

# Instalação

Via composer, faça o seguinte comando: 

```shell script
composer require edmarr2/d4sign-laravel
```

# OBSERVAÇÃO
Coloque dentro do seu .env as seguintes variáveis:

D4SIGN_BASE_URL = url


TOKEN_API = token


CRYPT_KEY = crypt

## Passo a Passo

### 1º - Realizar o upload do documento
### 2º - Cadastrar o webhook(POSTBack)
### 3º - Cadastrar os signatários
### 4º - Enviar o documento para assinatura
### 5º - Utilizar o EMBED D4Sign para exibir o documento em seu website

## Documentos

### Listar TODOS os documentos

Este objeto retornará TODOS os documentos da sua conta.

```php
use Edmarr2\D4sign\Services\Documents;

$documents = new Documents();
$docs = $documents->find();
```

### Listar um documento específico

Esse objeto retornará apenas o documento solicitado.

```php
use Edmarr2\D4sign\Services\Documents;

$documents = new Documents();
$docs = $documents->find("{UUID-DOCUMENT}");
```

### Listar TODOS os documentos de um cofre

Esse objeto retornará todos os documentos que estiverem associados ao cofre informado.

```php
use Edmarr2\D4sign\Services\Documents;

$documents = new Documents();
$docs = $documents->safe("{UUID-SAFE}");
```

### Listar TODOS os documentos de uma fase

Esse objeto retornará todos os documentos que estiverem na fase informada.

```php
use Edmarr2\D4sign\Services\Documents;

$documents = new Documents();
$docs = $documents->status("{ID-FASE}");
```

ID 1 - Processando
ID 2 - Aguardando Signatários
ID 3 - Aguardando Assinaturas
ID 4 - Finalizado
ID 5 - Arquivado
ID 6 - Cancelado


### Realizar o UPLOAD de um documento

Esse objeto realizará o UPLOAD do seu documento para os servidores da D4Sign.

Após o UPLOAD, o documento será criptografado em nossos cofres e carimbado com um número de série.

Após o processamento um preview será gerado. O processamento será realizado em background, ou seja, a requisição não ficará bloqueada.

Todos os documentos ficam armazenados em COFRES criptografados, ou seja, o parâmetro UUID-SAFE é obrigatório e determina em qual cofre o documento ficará armazenado.

```php
use Edmarr2\D4sign\Services\Documents;

$documents = new Documents();
$path_file = '/pasta/arquivo.pdf';
$id_doc = $documents->upload('{UUID-SAFE}', $path_file);
```

### Cadastrar signatários

Esse objeto realizará o cadastro dos signatários do documento, ou seja, quais pessoas precisam assinar esse documento.

```php
use Edmarr2\D4sign\Services\Documents;

$documents = new Documents();
$signers = [
    ["email" => "email1@dominio.com", "act" => '1', "foreign" => '0', "certificadoicpbr" => '0', "assinatura_presencial" => '0', "embed_methodauth" => 'email', "embed_smsnumber" => ''],
    ["email" => "email2@dominio.com", "act" => '1', "foreign" => '0', "certificadoicpbr" => '0',"assinatura_presencial" => '0', "embed_methodauth" => 'sms', "embed_smsnumber" => '+5511953020202']
];

$return = $documents->createList("{UUID-DOCUMENT}", $signers);
```

### Listar signatários de um documento

Esse objeto retornará todos os signatários de um documento.

```php
use Edmarr2\D4sign\Services\Documents;

$documents = new Documents();
$docs = $documents->listsignatures("{UUID-DOCUMENT}");
```

### Enviar um documento para assinatura

Esse objeto enviará o documento para assinatura, ou seja, o documento entrará na fase 'Aguardando assinaturas', onde, a partir dessa fase, os signatários poderão assinar os documentos.

```php
use Edmarr2\D4sign\Services\Documents;

$documents = new Documents();
$message = 'Prezados, segue o contrato eletrônico para assinatura.';
$workflow = 0; //Todos podem assinar ao mesmo tempo;
$skip_email = 1; //Não disparar email com link de assinatura (usando EMBED ou Assinatura Presencial);

$doc = $documents->sendToSigner("{UUID-DOCUMENT}",$message, $skip_email, $workflow);
```

### Cancelar um documento

Esse objeto irá cancelar o documento.

```php
use Edmarr2\D4sign\Services\Documents;

$documents = new Documents();
$docs = $documents->cancel("{UUID-DOCUMENT}");
```

### Reenviar link de assinatura

Esse objeto irá reenviar o link de assinatura para o signatário.

```php
use Edmarr2\D4sign\Services\Documents;

$documents = new Documents();
$email = 'email@dominio.com';
$return = $documents->resend('{UUID-DOCUMENT}', $email);
```

### Realizar o DOWNLOAD de um documento

Esse objeto irá disponibilizar um link para download do documento.

```php
use Edmarr2\D4sign\Services\Documents;

$documents = new Documents();
//Você poderá fazer download do ZIP ou apenas do PDF setando o último parametro.
$url_final = $documents->getfileurl('{UUID-DOCUMENT}','zip');
//print_r($url_final);

$arquivo = file_get_contents($url_final->url);

//CASO VOCÊ ESTEJA FAZENDO O DOWNLOAD APENAS DO PDF, NÃO ESQUEÇA DE ALTERAR O CONTENT-TYPE PARA application/pdf E O NOME DO ARQUIVO PARA .PDF
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=\"".$url_final->name.".zip"."\"");
echo $arquivo;
```

## WebHooks Services (POSTBack)

### Listar Webhook de um documento

Esse objeto irá retornar o webhook cadastrado no documento.

```php
use Edmarr2\D4sign\Services\Documents;

$documents = new Documents();
$webhook = $documents->webhooklist("{UUID-DOCUMENT}");
```

### Cadastrar Webhook em um documento

Esse objeto irá cadastrar o webhook no documento.

```php
use Edmarr2\D4sign\Services\Documents;

$documents = new Documents();
$url = 'http://seudominio.com.br/post.php';
$webhook = $documents->webhookadd("{UUID-DOCUMENT}",$url);
```

## Documentação completa da API

http://docapi.d4sign.com.br/

## Dúvidas?

Entre em contato com nossos desenvolvedores pelo e-mail suporte@d4sign.com.br
