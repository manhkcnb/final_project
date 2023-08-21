<?php 
namespace App\Repository;

use App\Models\Color;

class ColorRepository
{
    public function getAllColors()
    {
        return Color::orderBy('id', 'asc')->paginate(10);
    }

    public function getColorById($id)
    {
        return Color::findOrFail($id);
    }

    public function createColor($colorData)
    {
        return Color::create($colorData);
    }

    public function updateColor($id, $colorData)
    {
        $color = $this->getColorById($id);
        $color->update($colorData);
        return $color;
    }

    public function deleteColor($id)
    {
        $color = $this->getColorById($id);
        return $color->delete();
    }
}


 ?>