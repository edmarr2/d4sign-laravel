<?php

namespace Edmarr2\D4sign\Services;


class Documents extends Client
{
    public function changePasswordCode($documentKey, $keySigner, $email, $code)
    {
        return $this->post('documents/' . $documentKey . '/changepasswordcode', [
            'email' => json_encode($email),
            'password-code' => json_encode($code),
            'key-signer' => json_encode($keySigner)
        ]);
    }

    public function changeSmsNumber($documentKey, $keySigner, $email, $sms)
    {
        return $this->post('documents/' . $documentKey . '/changesmsnumber', [
            'email' => json_encode($email),
            'sms-number' => json_encode($sms),
            'key-signer' => json_encode($keySigner)
        ]);
    }


    public function removeEmail($documentKey, $email, $key)
    {
        return $this->post('documents/' . $documentKey . '/removeemaillist',  [
            'email-signer' => json_encode($email),
            'key-signer' => json_encode($key)
        ]);
    }

    public function changeEmail($documentKey, $email_before, $email_after,$key='')
    {
        return $this->post('documents/' . $documentKey . '/changeemail', [
            'email-before' => json_encode($email_before),
            'email-after' => json_encode($email_after),
            'key-signer' => json_encode($key)
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

    public function safe($safeKey, $uuid_folder = '', $page = 1)
    {
        return $this->get('documents/' . $safeKey . '/safe/' . $uuid_folder, [
            'pg' => $page
        ]);
    }

    public function upload($uuid_safe, $filePath, $uuid_folder = '')
    {
        return $this->_upload($uuid_safe, $filePath, $uuid_folder);
    }


    public function uploadBinary($uuid_safe, $base64_binary, $mime_type, $name, $uuid_folder = '')
    {
        return $this->post('documents/' . $uuid_safe . '/uploadbinary', [
            'base64_binary_file' => $base64_binary,
            'mime_type' => $mime_type,
            'name' => $name,
            'uuid_folder' => json_encode($uuid_folder)
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
            'comment' => json_encode($comment)
        ]);
    }

    public function createList($documentKey, $signers)
    {
        return $this->post('documents/' . $documentKey . '/createlist', [
            'signers' => json_encode($signers)
        ]);
    }

    public function makeDocumentByTemplate($documentKey, $name_document, $templates, $uuid_folder = '')
    {
        return $this->post('documents/' . $documentKey . '/makedocumentbytemplate', [
            'templates' =>  json_encode($templates),
            'name_document'=> json_encode($name_document),
            'uuid_folder'=> json_encode($uuid_folder)
        ]);
    }

    public function webhookAdd($documentKey, $url)
    {
        return $this->post('documents/' . $documentKey . '/webhooks', [
            'url' => json_encode($url)
        ]);
    }

    public function webhookList($documentKey)
    {
        return $this->get('documents/' . $documentKey . '/webhooks');
    }

    public function sendToSigner($documentKey, $message = '', $workflow = '0', $skip_email = false)
    {
        return $this->post('documents/' . $documentKey . '/sendtosigner', [
            'message' => json_encode($message),
            'workflow' => json_encode($workflow),
            'skip_email' => json_encode($skip_email)
        ]);
    }

    public function addInfo($documentKey, $email = '', $display_name = '', $documentation = '', $birthday = '', $key='')
    {
        return $this->post('documents/' . $documentKey . '/addinfo', [
            'key_signer' => json_encode($key),
            'email' => json_encode($email),
            'display_name' => json_encode($display_name),
            'documentation' => json_encode($documentation),
            'birthday' => json_encode($birthday)
        ]);
    }

    public function resend($documentKey, $email, $key='')
    {
        return $this->post('documents/' . $documentKey . '/resend', [
            "email" => json_encode($email),
            "key_signer" => json_encode($key)
        ]);
    }

    public function getFileUrl($documentKey, $type)
    {
        return $this->post('documents/' . $documentKey . '/download', [
            'type' => json_encode($type)
        ]);
    }


    private function _upload($uuid_safe, $filePath, $uuid_folder = '')
    {
        $f = $this->_getCurlFile($filePath);

        return $this->post('documents/' . $uuid_safe . '/upload', [
            'file' => $f,
            'uuid_folder'=> json_encode($uuid_folder)
        ]);

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

    public function uploadHash($uuid_safe, $sha256, $sha512, $name, $uuid_folder = '')
    {
        return $this->post('documents/' . $uuid_safe . '/uploadhash', [
            'sha256' => $sha256,
            'sha512' => $sha512,
            'name' => $name,
            'uuid_folder' => json_encode($uuid_folder)
        ]);

    }
}