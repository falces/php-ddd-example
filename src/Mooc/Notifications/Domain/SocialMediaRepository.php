<?php

namespace CodelyTv\Mooc\Notifications\Domain;

interface SocialMediaRepository
{
    public function newPost(SocialMediaPost $socialMediaPost);
}