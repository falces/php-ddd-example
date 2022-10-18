<?php

namespace CodelyTv\Mooc\Notifications\Domain;

use http\Client;
use http\Client\Request;
use HttpRequest;

interface SocialMediaRepository
{
    public function __construct();
    public function newPost(SocialMediaPost $socialMediaPost);
}