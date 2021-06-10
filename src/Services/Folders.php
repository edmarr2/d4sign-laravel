<?php

namespace Edmarr2\D4sign\Services;

class Folders extends Client
{
    public function find($uuidSafe)
    {
        return $this->get('folders/' . $uuidSafe . '/find');
    }

    public function create($uuidSafe, $folder_name)
    {
        return $this->post('folders/' . $uuidSafe . '/create', [
            'folder_name' => json_encode($folder_name)
        ]);
    }

    public function rename($uuidSafe, $uuidFolder, $folder_name)
    {
        return $this->post('folders/' . $uuidSafe . '/rename', [
            'folder_name' => json_encode($folder_name),
            'uuid_folder' => json_encode($uuidFolder)
        ]);
    }
}
