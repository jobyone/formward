<?php
/* Formward | https://gitlab.com/byjoby/formward | MIT License */
namespace Formward\Validators;

class Required extends AbstractValidator
{
    public function validate()
    {
        if ($this->field instanceof AbstractContainer) {
            return $this->validateContainer();
        } else {
            return $this->validateField();
        }
    }

    public function validateContainer()
    {
        return true;
    }

    public function validateField()
    {
        $value = $this->field->value();
        $value = "$value";
        if (!$value) {
            $this->message = 'This field is required';
            return false;
        }
        return true;
    }
}