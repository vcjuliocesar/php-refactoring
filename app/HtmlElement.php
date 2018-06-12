<?php
namespace App;

class HtmlElement
{
    private $name;
    private $attributes;
    private $content;
    
    public function __construct(string $name,$attributes = [], $content = null)
    {
        $this->name = $name;
        $this->attributes = $attributes;
        $this->content = $content;
    }

    public function render()
    {
        
        if($this->isVoid()) {
            return $this->open();
        }

        return $this->open().$this->content().$this->close();
    }

    public function open() : string
    {
        if($this->hasAttributes()) {
            return '<'.$this->name.$this->attributes().'>';
        } else {
            return '<'.$this->name.'>';
        }
    }

    public function hasAttributes() : bool
    {
        return ! empty($this->attributes);
    }

    public function attributes() : string
    {
        return array_reduce(array_keys($this->attributes), function ($result, $attribute) {
            return $result. $this->renderAttribute($attribute);
        },'');
    }

    protected function renderAttribute($attribute)
    {
        if(is_numeric($attribute)) {
            return ' '.$this->attributes[$attribute];
        }

        return ' '.$attribute.'="'.htmlentities($this->attributes[$attribute], ENT_QUOTES, 'UTF-8').'"'; // name="value";
    }

    public function isVoid() : bool
    {
        return in_array($this->name, ['br', 'hr', 'img', 'input', 'meta']);
    }

    public function content() : string
    {
        return htmlentities($this->content, ENT_QUOTES, 'UTF-8');
    }

    public function close() : string
    {
        return '</'.$this->name.'>';
    }
}