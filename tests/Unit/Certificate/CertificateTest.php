<?php

namespace Edmarr2\D4sign\Tests\Unit\Certificate;

use Edmarr2\D4sign\Services\Certificate;
use Edmarr2\D4sign\Tests\TestCase;

class CertificateTest extends TestCase
{
    private $certificate;

    public function testFindCertificateTest()
    {
        $this->certificate = new Certificate();
        $uuid_documento = "xxx-xxxxx-xxxx-xxxxxx";
        $key_signer = 'chave do signatário';
        $this->assertEquals('{"message":"Invalid key signer","mensagem_pt":"Chave do signat\u00e1rio inv\u00e1lida."}',
                            $this->certificate->find($uuid_documento, $key_signer));
    }
}