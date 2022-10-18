<?php

namespace CodelyTv\Mooc\Notifications\Domain;

use CodelyTv\Mooc\Courses\Domain\CourseName;
use CodelyTv\Mooc\Shared\Domain\Videos\VideoUrl;
use CodelyTv\Mooc\Videos\Domain\VideoTitle;
use CodelyTv\Mooc\Videos\Domain\VideoType;

class SocialMediaPost
{
    private const TEXT_VIDEO_TYPE_INTERVIEW = 'una nueva entrevista';
    private const TEXT_VIDEO_TYPE_DEFAULT   = 'un nuevo vídeo';

    private function __construct(
        private readonly string $text,
    ) {
    }

    public function getText(): string
    {
        return $this->text;
    }

    public static function create(
        VideoType $type,
        VideoTitle $title,
        VideoUrl $url,
        CourseName $courseName,
    ): SocialMediaPost {
        switch ($type) {
            case VideoType::INTERVIEW:
                $typeText = self::TEXT_VIDEO_TYPE_INTERVIEW;
                break;
            default:
                $typeText = self::TEXT_VIDEO_TYPE_DEFAULT;
        }

        $text = sprintf(
            '¡Hemos publicado %s! Puedes encontrar %s, correspondiente al curso %s, aquí: %s',
            $typeText,
            $title->value(),
            $courseName->value(),
            $url->value(),
        );

        return new self($text);
    }
}