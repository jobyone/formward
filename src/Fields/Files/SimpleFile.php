<?php
/**
 * Digraph CMS: Forms
 * https://github.com/digraphcms/digraph-forms

 * Copyright (c) 2017 Joby Elliott <joby@byjoby.com>

 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:

 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 */
namespace Digraph\Forms\Fields\Files;

use \Digraph\Forms\Fields\HTML5\Field;

class SimpleFile extends Field
{

    public function __construct($label = null)
    {
        parent::__construct($label);
        $this->_tagAttributes['type'] = 'file';
    }

    public function __toString()
    {
        $this->_tagAttributes['value'] = '';
        return parent::__toString();
    }

    public function size($bytes)
    {
        $this->addTip("Maximum size: ".static::sizeHR($bytes), 'size');
        $this->addConstraint('fsize', $bytes);
    }

    public function getValue()
    {
        if (isset($_FILES[$this->getName()]) && $_FILES[$this->getName()]['error'] == 0) {
            return $_FILES[$this->getName()];
        }
        return null;
    }

    protected function _constraint_fsize(&$field, $bytes)
    {
        $value = $this->getValue();
        if ($value['size'] > $bytes) {
            return "File can't be more than ".static::sizeHR($bytes);
        }
        return static::STATE_VALID;
    }

    public static function sizeHR($bytes)
    {
        $steps = array(
            'KB'=>1024,
            'MB'=>1024,
            'GB'=>1024
        );
        $outNum = $bytes;
        $outSuffix = 'B';
        foreach ($steps as $suffix => $mult) {
            $newNum = $outNum/$mult;
            if ($newNum < 1) {
                break;
            }
            $outNum = $newNum;
            $outSuffix = $suffix;
        }
        return (round($outNum*10)/10).$outSuffix;
    }
}