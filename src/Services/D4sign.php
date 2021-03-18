<?php
namespace Edmarr2\D4sign\Services;


class D4sign
{
    public $account;
    public $batches;
    public $certificate;
    public $documents;
    public $folders;
    public $groups;
    public $safes;
    public $tags;
    public $templates;
    public $users;
    public $watcher;

    public function __construct()
    {
        $this->account = new Account();
        $this->batches = new Batches();
        $this->certificate = new Certificate();
        $this->documents = new Documents();
        $this->folders = new Folders();
        $this->groups = new Groups();
        $this->safes = new Safes();
        $this->tags = new Tags();
        $this->templates = new Templates();
        $this->users = new Users();
        $this->watcher = new Watcher();
    }
}