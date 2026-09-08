<?php

namespace App\Enums;

enum CourseCategory: string
{
    case ComputerScience = 'computer_science';
    case It = 'it';
    case CyberSecurity = 'cyber_security';
    case Language = 'language';
    case Arts = 'arts';
    case Business = 'business';
    case SocialSciences = 'social_sciences';
    case Humanities = 'humanities';
    case Engineering = 'engineering';
    case Math = 'math';
    case Physics = 'physics';
    case Chemistry = 'chemistry';
    case Biology = 'biology';
    case Geology = 'geology';
    case Astronomy = 'astronomy';

    public function label(): string
    {
        return match ($this) {
            self::ComputerScience => 'Computer Science',
            self::It => 'Information Technology (IT)',
            self::CyberSecurity => 'Cybersecurity',
            self::Language => 'Language',
            self::Arts => 'Arts',
            self::Business => 'Business',
            self::SocialSciences => 'Social Sciences',
            self::Humanities => 'Humanities',
            self::Engineering => 'Engineering',
            self::Math => 'Math',
            self::Physics => 'Physics',
            self::Chemistry => 'Chemistry',
            self::Biology => 'Biology',
            self::Geology => 'Geology',
            self::Astronomy => 'Astronomy',
        };
    }
}