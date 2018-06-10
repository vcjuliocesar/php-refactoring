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
        $result = $this->open();
        
        if($this->isVoid()) {
            return $result;
        }

        $result .= $this->content();

        $result .= $this->close();

        return $result;
    }

    public function open() : string
    {
        if(! empty($this->attributes)) {
            $result = '<'.$this->name.$this->attributes().'>';
        } else {
            $result = '<'.$this->name.'>';
        }

        return $result;
    }

    public function attributes() : string
    {
        $htmlAttributes='';

        foreach($this->attributes as $attribute => $value) {
            $htmlAttributes.= $this->renderAttributes($attribute,$value);
        }

        return $htmlAttributes;
    }

    protected function renderAttributes($attribute,$value)
    {
        if(is_numeric($attribute)) {
            $htmlAttributes = ' '.$value;
        } else {
            $htmlAttributes =  ' '.$attribute.'="'.htmlentities($value, ENT_QUOTES, 'UTF-8').'"'; // name="value";
        }

        return $htmlAttributes;
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