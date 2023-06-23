<?php

namespace PalaganTeam\MuhKansai\Model\News;
class NewsCreateRequest{
    public ?string $newsTitle = null;
    public $newsImage = null;
    public ?string $newsDescr = null;
}