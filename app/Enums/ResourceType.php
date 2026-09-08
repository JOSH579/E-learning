<?php

namespace App\Enums;

enum ResourceType: string
{
    case Course = 'course';
    case Notes = 'notes';
    case Video = 'video';

    public function label(): string
    {
        return match ($this) {
            self::Course => 'Course',
            self::Notes => 'Notes (PDF/Docs)',
            self::Video => 'Videos',
        };
    }
}