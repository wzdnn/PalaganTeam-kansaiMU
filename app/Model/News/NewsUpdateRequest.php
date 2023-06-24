<?php

namespace PalaganTeam\MuhKansai\Model\News;
class NewsUpdateRequest extends NewsCreateRequest{
    public ?int $idNews = null;
    public ?bool $imageChange = false;
}