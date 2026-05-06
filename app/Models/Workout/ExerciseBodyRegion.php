<?php

namespace App\Models\Workout;

enum ExerciseBodyRegion
{
    case UPPER_BODY;
    case LOWER_BODY;
    case CORE;
    case FULL_BODY;

    /**
     * @param ?int $bodyRegionCode Representative code for the region
     * @return ExerciseBodyRegion|null Region associated to the code *(or null
     * if there is no such region)*
     */
    public static function ofCode(?int $bodyRegionCode): ?self
    {
        return match ($bodyRegionCode) {
            1 => self::UPPER_BODY,
            2 => self::LOWER_BODY,
            3 => self::CORE,
            4 => self::FULL_BODY,
            default => null
        };
    }

    /**
     * @return int The representative code for the body region.
     */
    public function toCode(): int
    {
        return match ($this) {
            self::UPPER_BODY => 1,
            self::LOWER_BODY => 2,
            self::CORE => 3,
            self::FULL_BODY => 4
        };
    }

    /**
     * @return string Readable name of the body region variant
     */
    public function naturalName(): string
    {
        // TODO: Replace this with actual internationalization
        return ucfirst(strtolower(str_replace('_', ' ', $this->name)));
    }
}
