<?php

namespace App\Mapper;

use App\Model\ChallengeSubmittion;

class SubmittionMapper
{
  public static function fromDomainFormat(ChallengeSubmittion $submittion)
  {
    $appFormatData = [];
    $appFormatData['id'] = $submittion->id;
    $appFormatData['points'] = $submittion->points;
    $appFormatData['image'] = $submittion->image;
    $appFormatData['status_id'] = $submittion->status_id;
    $appFormatData['comment'] = $submittion->comment;

    $appFormatData['user'] = UserMapper::fromDomainFormat($submittion->user);
    $appFormatData['challenge'] = ChallengeMapper::fromDomainFormat($submittion->challenge);

    return $appFormatData;
  }

  public static function fromDomainFormatList($submittions)
  {
    $allData = [];
    foreach ($submittions as $submittion) {
      $allData[] = self::fromDomainFormat($submittion);
    }
    return $allData;
  }
}
