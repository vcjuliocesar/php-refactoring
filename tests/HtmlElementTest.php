<?php
namespace Tests;

use App\HtmlElement;

class HtmlElementTest extends TestCase
{
    /** @test */
    function it_generates_html_elements_with_content()
    {
        $element = new HtmlElement('p',[],'Este es el contenido');
        $this->assertSame(
            '<p>Este es el contenido</p>',
            $element->render()
        );
    }

    /** @test */
    function it_generates_html_elements_with_content_and_an_id_attribute()
    {
        $element = new HtmlElement('p',['id' => 'my_paragraph'],'Este es el contenido');
        $this->assertSame(
            '<p id="my_paragraph">Este es el contenido</p>',
            $element->render()
        );
    }

    /** @test */
    function it_generates_html_elements_with_multiple_attributes()
    {
        $element = new HtmlElement('p',['id' => 'my_paragraph','class' => 'paragraph'],'Este es el contenido');
        $this->assertSame(
            '<p id="my_paragraph" class="paragraph">Este es el contenido</p>',
            $element->render()
        );
    }

    /** @test */
    function it_generates_an_img_tag()
    {
        $element = new HtmlElement('img',['src' => 'img/styde.png']);
        $this->assertSame(
            '<img src="img/styde.png">',
            $element->render()
        );
    }

     /** @test */
     function it_escapes_the_html_attributes()
     {
         $element = new HtmlElement('img',['src' => 'img/styde.png','title' => 'Curso de "Refactorización" en Styde']);
         $this->assertSame(
             '<img src="img/styde.png" title="Curso de &quot;Refactorizaci&oacute;n&quot; en Styde">',
             $element->render()
         );
     }

     /** @test */
     function it_generates_elements_with_boolean_attributes()
     {
         $element = new HtmlElement('input', ['required']);
         $this->assertSame(
             '<input required>',
             $element->render()
         );
     }
}