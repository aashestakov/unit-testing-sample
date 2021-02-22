<?php
namespace Shestakov\Mailer;

class Standard implements Mailer
{
    public function send(): void 
    {
        mail('test@gmail.com', 'Hello', 'World');
    }
}