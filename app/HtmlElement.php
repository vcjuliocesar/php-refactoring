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
        $this->attributes = new HtmlAttributes($attributes);
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
        return '<'.$this->name.$this->attributes().'>';
    }

    public function attributes() : string
    {
        return $this->attributes->render();
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