<?php

namespace Edmarr2\D4sign\Services;


class Documents extends Client
{
    public function changepasswordcode($documentKey, $keySigner, string $email, $code)
    {
        return $this->post('/documents/' . $documentKey . '/changepasswordcode', [
            'email' => $email,
            'password-code' => $code,
            'key-signer' => $keySigner
        ]);
    }

    public function changesmsnumber($documentKey, $keySigner, string $email, string $sms)
    {
        return $this->post('/documents/' . $documentKey . '/changesmsnumber', [
            'email' => $email,
            'sms-number' => $sms,
            'key-signer' => $keySigner
        ]);
    }


    public function removeemail($documentKey, $email, $key)
    {
        return $this->post('/documents/' . $documentKey . '/removeemaillist',  [
            'email-signer' => $email,
            'key-signer' => $key
        ]);
    }

    public function changeemail($documentKey, $email_before, $email_after,$key='')
    {
        return $this->post('/documents/' . $documentKey . '/changeemail', [
            'email-before' => $email_before,
            'email-after' => $email_after,
            'key-signer' => $key
        ]);
    }

    public function find($documentKey = '', $page = 1)
    {
        return $this->get('/documents/' . $documentKey, [
            'pg' => $page
        ]);
    }

    public function listsignatures($documentKey)
    {
        return $this->get('/documents/' . $documentKey . '/list');
    }

    public function status($status, $page = 1)
    {
        return $this->get('/documents/' . $status . '/status', [
            'pg' => $page
        ]);
    }

    public function safe($safeKey, $uuid_folder = '', $page = 1)
    {
        return $this->get('/documents/' . $safeKey . '/safe/' . $uuid_folder, [
            'pg' => $page
        ]);
    }

    public function upload(string $uuid_safe, $filePath, $uuid_folder = '')
    {
        return $this->_upload($uuid_safe, $filePath, $uuid_folder);
    }


    public function uploadbinary(string $uuid_safe, $base64_binary, $mime_type, $name, $uuid_folder = '')
    {
        return $this->post('/documents/' . $uuid_safe . '/uploadbinary', [
            'base64_binary_file' => $base64_binary,
            'mime_type' => $mime_type,
            'name' => $name,
            'uuid_folder' => $uuid_folder
        ]);
    }

    public function uploadslavebinary(string $uuid_master, $base64_binary, $mime_type, $name)
    {
        return $this->post('/documents/' . $uuid_master . '/uploadslavebinary', [
            'base64_binary_file' => $base64_binary,
            'mime_type'=>$mime_type,
            'name'=>$name
        ]);

    }

    public function uploadslave(string $uuid_original_file, $filePath)
    {
        return $this->_uploadslave($uuid_original_file, $filePath);
    }

    public function cancel($documentKey, $comment = '')
    {
        return $this->post('/documents/' .$documentKey . '/cancel', [
            'comment' => $comment
        ]);
    }

    public function createList($documentKey, $signers)
    {
        return $this->post('/documents/' . $documentKey . '/createlist', [
            'signers' => $signers
        ]);
    }

    public function makedocumentbytemplate($documentKey, $name_document, $templates, $uuid_folder = '')
    {
        return $this->post('/documents/' . $documentKey . '/makedocumentbytemplate', [
            'templates' =>  $templates,
            'name_document'=> $name_document,
            'uuid_folder'=> $uuid_folder
        ]);
    }

    public function webhookadd($documentKey, $url)
    {
        return $this->post('/documents/' . $documentKey . '/webhooks', [
            'url' => $url
        ]);
    }

    public function webhooklist($documentKey)
    {
        return $this->client->request("/documents/$documentKey/webhooks", "GET", null, 200);
    }

    public function sendToSigner($documentKey, $message = '', $workflow = '0', $skip_email = false)
    {
        return $this->post('/documents/' . $documentKey . '/sendtosigner', [
            'message' => json_encode($message),
            'workflow' => json_encode($workflow),
            'skip_email' => json_encode($skip_email)
        ]);
    }

    public function addinfo($documentKey, $email = '', $display_name = '', $documentation = '', $birthday = '', $key='')
    {
        return $this->post('/documents/' . $documentKey . '/addinfo', [
            'key_signer' => $key,
            'email' => $email,
            'display_name' => $display_name,
            'documentation' => $documentation,
            'birthday' => $birthday
        ]);
    }

    public function resend($documentKey, $email, $key='')
    {
        return $this->post('/documents/' . $documentKey . '/resend', [
            "email" => json_encode($email),
            "key_signer" => json_encode($key)
        ]);
    }

    public function getfileurl($documentKey, $type)
    {
        return $this->post('/documents/' . $documentKey . '/download', [
            'type' => $type
        ]);
    }


    private function _upload($uuid_safe, $filePath, $uuid_folder = '')
    {
        $f = $this->_getCurlFile($filePath);

        return $this->post('/documents/' . $uuid_safe . '/upload', [
            'file' => $f,
            'uuid_folder'=> $uuid_folder
        ]);

    }

    private function _uploadslave($uuid_original_file, $filePath)
    {
        $f = $this->_getCurlFile($filePath);

        return $this->client->request('/documents/' . $uuid_original_file . '/uploadslave', ['file' => $f]);
    }

    private function _getCurlFile($filename, $contentType='', $postname='')
    {
        // PHP 5.5 introduced a CurlFile object that deprecates the old @filename syntax
        // See: https://wiki.php.net/rfc/curl-file-upload
        if (function_exists('curl_file_create'))
        {
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $finfo = finfo_file($finfo, $filename);

            return curl_file_create($filename, $finfo, basename($filename));
        }

        // Use the old style if using an older version of PHP
        $postname = $postname or $filename;
        $value = "@{$filename};filename=" . $postname;
        if ($contentType)
        {
            $value .= ';type=' . $contentType;
        }else{
            $value .= ';type=' . mime_content_type($filename);
        }

        return $value;
    }

    public function uploadhash(string $uuid_safe, $sha256, $sha512, $name, $uuid_folder = '')
    {
        return $this->post('/documents/' . $uuid_safe . '/uploadhash', [
            'sha256' => $sha256,
            'sha512' => $sha512,
            'name' => $name,
            'uuid_folder' => $uuid_folder
        ]);

    }
}