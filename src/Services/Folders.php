<?php

namespace Edmarr2\D4sign\Services;

class Folders extends Client
{
    /**
     * @param $uuidSafe
     *
     * @return mixed
     */
    public function find($uuidSafe)
    {
        return $this->get('folders/'.$uuidSafe.'/find');
    }

    /**
     * @param $uuidSafe
     * @param $folderName
     *
     * @return mixed
     */
    public function create($uuidSafe, $folderName)
    {
        return $this->post('folders/'.$uuidSafe.'/create', [
            'folder_name' => $folderName,
        ]);
    }

    /**
     * @param $uuidSafe
     * @param $uuidFolder
     * @param $folderName
     *
     * @return mixed
     */
    public function rename($uuidSafe, $uuidFolder, $folderName)
    {
        return $this->post('folders/'.$uuidSafe.'/rename', [
            'folder_name' => $folderName,
            'uuid_folder' => $uuidFolder,
        ]);
    }

}
