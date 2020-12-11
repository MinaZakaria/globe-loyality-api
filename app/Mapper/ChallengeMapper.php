<?php

namespace App\Mapper;

use App\Model\Challenge;
use App\Utilities\DateTimeUtility;

class ChallengeMapper
{
    public static function fromDomainFormat(Challenge $challenge)
    {
        $appFormatData = [];
        $appFormatData['id'] = $challenge->id;
        $appFormatData['name'] = $challenge->name;
        $appFormatData['description'] = $challenge->description;
        $appFormatData['image_url'] = $challenge->image_url;
        $appFormatData['program_id'] = $challenge->program_id;
        $appFormatData['created_by'] = $challenge->created_by;
        $appFormatData['is_active'] = $challenge->is_active;
        $appFormatData['created_at'] = DateTimeUtility::ISO($challenge->created_at);
        $appFormatData['updated_at'] = DateTimeUtility::ISO($challenge->updated_at);

        return $appFormatData;
    }

    public static function fromDomainFormatList(array $users)
    {
        $allData = [];
        foreach ($users as $user) {
            $allData[] = self::fromDomainFormat($user);
        }
        return $allData;
    }
}
