<?php
// app/Repositories/SizeRepository.php

namespace App\Repository;

use App\Models\Size;

class SizeRepository
{
    public function getAllSizes()
    {
        return Size::orderBy('id', 'asc')->get();
    }

    public function getById($id)
    {
        return Size::find($id);
    }

    public function update($id, $data)
    {
        Size::where('id', $id)->update($data);
    }

    public function create($data)
    {
        Size::create($data);
    }

    public function delete($id)
    {
        Size::where('id', $id)->delete();
    }
}
