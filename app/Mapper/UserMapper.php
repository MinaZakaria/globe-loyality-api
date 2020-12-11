<?php

namespace App\Mapper;

use App\Model\User;
use App\Utilities\DateTimeUtility;

class UserMapper
{
    public static function fromDomainFormat(User $user)
    {
        $appFormatData = [];
        $appFormatData['id'] = $user->id;
        $appFormatData['name'] = $user->name;
        $appFormatData['email'] = $user->email;
        $appFormatData['points'] = $user->points;
        $appFormatData['is_admin'] = $user->is_admin;
        $appFormatData['status_id'] = $user->status_id;
        $appFormatData['role_id'] = $user->role_id;
        $appFormatData['email_verified_at'] = DateTimeUtility::ISO($user->email_verified_at);
        $appFormatData['created_at'] = DateTimeUtility::ISO($user->created_at);
        $appFormatData['updated_at'] = DateTimeUtility::ISO($user->updated_at);

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
