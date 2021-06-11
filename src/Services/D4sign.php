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

    public function __construct(
        Account $account,
        Batches $batches,
        Certificate $certificate,
        Documents $documents,
        Folders $folders,
        Groups $groups,
        Safes $safes,
        Tags $tags,
        Templates $templates,
        Users $users,
        Watcher $watcher
    ) {
        $this->account     = $account;
        $this->batches     = $batches;
        $this->certificate = $certificate;
        $this->documents   = $documents;
        $this->folders     = $folders;
        $this->groups      = $groups;
        $this->safes       = $safes;
        $this->tags        = $tags;
        $this->templates   = $templates;
        $this->users       = $users;
        $this->watcher     = $watcher;
    }

    public function account()
    {
        return $this->account;
    }

    public function batches()
    {
        return $this->batches;
    }

    public function certificate()
    {
        return $this->certificate;
    }

    public function documents()
    {
        return $this->documents;
    }

    public function folders()
    {
        return $this->folders;
    }

    public function groups()
    {
        return $this->groups;
    }

    public function safes()
    {
        return $this->safes;
    }

    public function tags()
    {
        return $this->tags;
    }

    public function templates()
    {
        return $this->templates;
    }

    public function users()
    {
        return $this->users;
    }

    public function watcher()
    {
        return $this->watcher;
    }
}
