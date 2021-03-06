<?php
/* Formward | https://gitlab.com/byjoby/formward | MIT License */
namespace Formward\SystemFields;

use Formward\FieldInterface;
use Formward\AbstractField;

abstract class AbstractSystemField extends AbstractField
{
    public function __construct(string $label, string $name=null, FieldInterface $parent=null)
    {
        parent::__construct($label, $name, $parent);
        $this->attr('type', 'hidden');
        $this->addClass('SystemField');
    }

    /**
     * prefix all system field names with an _ to prevent collisions with
     * user-space fields
     */
    public function name($name = null)
    {
        return '_'.parent::name($name);
    }

    protected function fieldAttributes()
    {
        $attr = parent::fieldAttributes();
        $attr['value'] = $this->value();
        return $attr;
    }
}
