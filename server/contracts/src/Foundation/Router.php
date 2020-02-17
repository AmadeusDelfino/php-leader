<?php


namespace ADelf\LeaderServer\Contracts\Foundation;


interface Router
{
    public function handler(\Psr\Http\Message\ServerRequestInterface $request);
}