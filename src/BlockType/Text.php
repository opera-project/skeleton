<?php

namespace App\BlockType;

class Text extends BaseBlock implements BlockTypeInterface
{
    public function getType() : string
    {
        return 'text';
    }
}