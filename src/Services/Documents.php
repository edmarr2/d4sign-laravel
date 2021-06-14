<?php

namespace Edmarr2\D4sign\Services;

use GuzzleHttp\Psr7;

class Documents extends Client
{
    public function changePasswordCode($documentKey, $keySigner, $email, $code)
    {
        return $this->post('documents/' . $documentKey . '/changepasswordcode', [
            'email' => $email,
            'password-code' => $code,
            'key-signer' => $keySigner
        ]);
    }

    public function changeSmsNumber($documentKey, $keySigner, $email, $sms)
    {
        return $this->post('documents/' . $documentKey . '/changesmsnumber', [
            'email' => $email,
            'sms-number' => $sms,
            'key-signer' => $keySigner
        ]);
    }


    public function removeEmail($documentKey, $email, $key)
    {
        return $this->post('documents/' . $documentKey . '/removeemaillist', [
            'email-signer' => $email,
            'key-signer' => $key,
        ]);
    }

    public function changeEmail($documentKey, $email_before, $email_after, $key='')
    {
        return $this->post('documents/' . $documentKey . '/changeemail', [
            'email-before' => $email_before,
            'email-after' => $email_after,
            'key-signer' => $key,
        ]);
    }

    public function find($documentKey = '', $page = 1)
    {
        return $this->get('documents/' . $documentKey, [
            'pg' => $page
        ]);
    }

    public function listSignatures($documentKey)
    {
        return $this->get('documents/' . $documentKey . '/list');
    }

    public function status($status, $page = 1)
    {
        return $this->get('documents/' . $status . '/status', [
            'pg' => $page
        ]);
    }

    public function safe($safeKey, $uuidFolder = '', $page = 1)
    {
        return $this->get('documents/' . $safeKey . '/safe/' . $uuidFolder, [
            'pg' => $page
        ]);
    }

    public function upload($uuidSafe, $filePath, $uuidFolder = '')
    {
        if (! $uuidSafe) {
            return 'UUID Safe not set.';
        }
        return $this->_upload($uuidSafe, $filePath, $uuidFolder);
    }


    public function uploadBinary($uuidSafe, $base64_binary, $mime_type, $name, $uuidFolder = '')
    {
        return $this->post('documents/' . $uuidSafe . '/uploadbinary', [
            'base64_binary_file' => $base64_binary,
            'mime_type' => $mime_type,
            'name' => $name,
            'uuid_folder' => ($uuidFolder)
        ]);
    }

    public function uploadSlaveBinary($uuid_master, $base64_binary, $mime_type, $name)
    {
        return $this->post('documents/' . $uuid_master . '/uploadslavebinary', [
            'base64_binary_file' => $base64_binary,
            'mime_type'=>$mime_type,
            'name'=>$name
        ]);
    }

    public function uploadSlave($uuid_original_file, $filePath)
    {
        return $this->_uploadSlave($uuid_original_file, $filePath);
    }

    public function cancel($documentKey, $comment = '')
    {
        return $this->post('documents/' .$documentKey . '/cancel', [
            'comment' => ($comment)
        ]);
    }

    public function createList($documentKey, $signers)
    {
        return $this->post('documents/' . $documentKey . '/createlist', [
            'signers' => ($signers)
        ]);
    }

    /**
     * @param $documentKey
     * @param $documentName
     * @param $templates
     * @param  string  $uuidFolder
     *
     * @return mixed
     */
    public function makeDocumentByTemplate($documentKey, $documentName, $templates, $uuidFolder = '')
    {
        return $this->post('documents/' . $documentKey . '/makedocumentbytemplate', [
            'templates' =>  $templates,
            'name_document'=> $documentName,
            'uuid_folder'=> $uuidFolder
        ]);
    }

    /**
     * @param $documentKey
     * @param $url
     *
     * @return mixed
     */
    public function webhookAdd($documentKey, $url)
    {
        return $this->post('documents/' . $documentKey . '/webhooks', [
            'url' => ($url)
        ]);
    }

    /**
     * @param $documentKey
     *
     * @return mixed
     */
    public function webhookList($documentKey)
    {
        return $this->get('documents/' . $documentKey . '/webhooks');
    }

    public function sendToSigner($documentKey, $message = '', $workflow = '0', $skip_email = false)
    {
        return $this->post('documents/' . $documentKey . '/sendtosigner', [
            'message' => $message,
            'workflow' => $workflow,
            'skip_email' => $skip_email
        ]);
    }

    public function addInfo($documentKey, $email = '', $display_name = '', $documentation = '', $birthday = '', $key='')
    {
        return $this->post('documents/' . $documentKey . '/addinfo', [
            'key_signer' => $key,
            'email' => $email,
            'display_name' => $display_name,
            'documentation' => $documentation,
            'birthday' => $birthday,
        ]);
    }

    public function resend($documentKey, $email, $key='')
    {
        return $this->post('documents/' . $documentKey . '/resend', [
            "email" => $email,
            "key_signer" => $key
        ]);
    }

    public function getFileUrl($documentKey, $type)
    {
        return $this->post('documents/' . $documentKey . '/download', [
            'type' => $type
        ]);
    }


    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function _upload($uuidSafe, $filePath, $uuidFolder = '')
    {
        return $this->client->request(
            'POST',
            'documents/' . $uuidSafe . '/upload',
            [
                'multipart' => [
                    [
                        'name'     => 'file',
                        'contents' => Psr7\Utils::tryFopen($filePath, 'r'),
                    ],
                    [
                        'name'     => 'uuid_folder',
                        'contents' => $uuidFolder,
                    ]
                ]
            ]
        );
    }

    private function _uploadSlave($uuid_original_file, $filePath)
    {
        $f = $this->_getCurlFile($filePath);

        return $this->post('documents/' . $uuid_original_file . '/uploadslave', ['file' => $f]);
    }

    private function _getCurlFile($filename, $contentType='', $postname='')
    {
        // PHP 5.5 introduced a CurlFile object that deprecates the old @filename syntax
        // See: https://wiki.php.net/rfc/curl-file-upload
        if (function_exists('curl_file_create')) {
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $finfo = finfo_file($finfo, $filename);
            return curl_file_create($filename, $finfo, basename($filename));
        }

        // Use the old style if using an older version of PHP
        $postname = $postname or $filename;
        $value = "@{$filename};filename=" . $postname;
        if ($contentType) {
            $value .= ';type=' . $contentType;
        } else {
            $value .= ';type=' . mime_content_type($filename);
        }
        return $value;
    }

    public function uploadHash($uuidSafe, $sha256, $sha512, $name, $uuidFolder = '')
    {
        return $this->post('documents/' . $uuidSafe . '/uploadhash', [
            'sha256' => $sha256,
            'sha512' => $sha512,
            'name' => $name,
            'uuid_folder' => $uuidFolder,
        ]);
    }
}
