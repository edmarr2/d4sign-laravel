# D4Sign Laravel Client - SDK

SDK Não oficial de integração á API do serviço [D4Sign REST API](http://docapi.d4sign.com.br/).

# Instalação
Abra o arquivo `composer.json` e insira a seguinte instrução
```
"require": {
    "edmarr2/d4sign-laravel": "dev-master"
}
``` 


Via composer, execute o seguinte comando: 

```shell script
composer require edmarr2/d4sign-laravel
```

# Criação do configurador
```php artisan vendor:publish --tag=d4sign-config```

# Configuração

Coloque dentro do seu .env as seguintes variáveis:

D4SIGN_ENV = ``homologacao`` | `producao`

- homologação, utiliza o endpoint de demonstração - sem validade jurídica
- produção, utiliza o endpoint de produção - com validade jurídica.

D4SIGN_TOKEN_API = token

D4SIGN_CRYPT_KEY = crypt

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
$docs = \Edmarr2\D4sign\Facades\D4Sign::documents()->find();
```

### Listar um documento específico

Esse objeto retornará apenas o documento solicitado.

```php
$docs = \Edmarr2\D4sign\Facades\D4Sign::documents()->find("{UUID-DOCUMENT}");
```

### Listar TODOS os documentos de um cofre
Para simplificar a requisição foi pensado em instanciar uma classe
```php
$docs = \Edmarr2\D4sign\Facades\D4Sign::documents()->safe("{UUID-SAFE}");
```

Esse objeto retornará todos os documentos que estiverem associados ao cofre informado.

```php
$docs = \Edmarr2\D4sign\Facades\D4Sign::documents()->safe("{UUID-SAFE}");
```

### Listar TODOS os documentos de uma fase

Esse objeto retornará todos os documentos que estiverem na fase informada.

```php
$docs = \Edmarr2\D4sign\Facades\D4Sign::documents()->status("{ID-FASE}");
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
$path_file = '/pasta/arquivo.pdf';
$id_doc = \Edmarr2\D4sign\Facades\D4Sign::documents()->upload('{UUID-SAFE}', $path_file);
```

### Cadastrar signatários

Esse objeto realizará o cadastro dos signatários do documento, ou seja, quais pessoas precisam assinar esse documento.

```php
$signers = [
    ["email" => "email1@dominio.com", "act" => '1', "foreign" => '0', "certificadoicpbr" => '0', "assinatura_presencial" => '0', "embed_methodauth" => 'email', "embed_smsnumber" => ''],
    ["email" => "email2@dominio.com", "act" => '1', "foreign" => '0', "certificadoicpbr" => '0',"assinatura_presencial" => '0', "embed_methodauth" => 'sms', "embed_smsnumber" => '+5511953020202']
];

$return = \Edmarr2\D4sign\Facades\D4Sign::documents()->createList("{UUID-DOCUMENT}", $signers);
```

### Listar signatários de um documento

Esse objeto retornará todos os signatários de um documento.

```php
$docs = \Edmarr2\D4sign\Facades\D4Sign::documents()->listSignatures("{UUID-DOCUMENT}");
```

### Enviar um documento para assinatura

Esse objeto enviará o documento para assinatura, ou seja, o documento entrará na fase 'Aguardando assinaturas', onde, a partir dessa fase, os signatários poderão assinar os documentos.

```php
$message = 'Prezados, segue o contrato eletrônico para assinatura.';
$workflow = 0; //Todos podem assinar ao mesmo tempo;
$skip_email = 1; //Não disparar email com link de assinatura (usando EMBED ou Assinatura Presencial);

$doc = \Edmarr2\D4sign\Facades\D4Sign::documents()->sendToSigner("{UUID-DOCUMENT}",$message, $skip_email, $workflow);
```

### Cancelar um documento

Esse objeto irá cancelar o documento.

```php
$docs = \Edmarr2\D4sign\Facades\D4Sign::documents()->cancel("{UUID-DOCUMENT}");
```

### Reenviar link de assinatura

Esse objeto irá reenviar o link de assinatura para o signatário.

```php
$email = 'email@dominio.com';
$return = \Edmarr2\D4sign\Facades\D4Sign::documents()->resend('{UUID-DOCUMENT}', $email);
```

### Realizar o DOWNLOAD de um documento

Esse objeto irá disponibilizar um link para download do documento.

```php
//Você poderá fazer download do ZIP ou apenas do PDF setando o último parametro.
$url_final = \Edmarr2\D4sign\Facades\D4Sign::documents()->getFileUrl('{UUID-DOCUMENT}','zip');
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
$webhook = \Edmarr2\D4sign\Facades\D4Sign::documents()->webhookList("{UUID-DOCUMENT}");
```

### Cadastrar Webhook em um documento

Esse objeto irá cadastrar o webhook no documento.

```php
$url = 'http://seudominio.com.br/post.php';
$webhook = \Edmarr2\D4sign\Facades\D4Sign::documents()->webhookAdd("{UUID-DOCUMENT}",$url);
```

## Documentação completa da API

http://docapi.d4sign.com.br/
