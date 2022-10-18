<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Notifications\Application\PublishInSocialMediaOnNewVideo;

use CodelyTv\Mooc\Courses\Domain\CourseNotExist;
use CodelyTv\Mooc\Courses\Domain\CourseRepository;
use CodelyTv\Mooc\Notifications\Domain\SocialMediaPost;
use CodelyTv\Mooc\Notifications\Domain\SocialMediaRepository;
use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;
use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Mooc\Videos\Domain\VideoNotFound;
use CodelyTv\Mooc\Videos\Domain\VideoRepository;

final class PublishInSocialMediaOnNewVideo
{
    public function __construct(
        private readonly SocialMediaRepository $socialMediaRepository,
        private readonly CourseRepository $courseRepository,
        private readonly VideoRepository $videoRepository,
    ) {
    }

    public function create(
        string $videoId,
        string $courseId,
    ): void {
        $videoId = new VideoId($videoId);
        $video = $this->videoRepository->search($videoId) ??
            throw new VideoNotFound($videoId);

        $courseId = new CourseId($courseId);
        $course = $this->courseRepository->search($courseId) ??
            throw new CourseNotExist($courseId);

        $post = SocialMediaPost::create(
            $video->type(),
            $video->title(),
            $video->url(),
            $course->name(),
        );

        $response = $this->socialMediaRepository->newPost($post);
    }
}
