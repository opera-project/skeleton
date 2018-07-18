<?php

namespace App\BlockType;

interface BlockTypeInterface
{
    public function getType() : string;

    public function getTemplate() : string;
    
    public function getVariables() : array;
    
}