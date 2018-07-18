<?= "<?php\n" ?>

namespace <?= $namespace ?>;

class <?= $class_name ?> extends BaseBlock implements BlockTypeInterface
{
    public function getType() : string
    {
        return '<?= $block ?>';
    }
}