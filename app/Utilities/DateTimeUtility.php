<?php

namespace App\Utilities;

use DateTime;

class DateTimeUtility
{
  public static function UTC(string $datetime = null, bool $endOfDay = false)
  {
    if (!$datetime) {
      return null;
    }

    $temp = new DateTime($datetime);
    if ($endOfDay) {
      $temp->setTime(23, 59, 59);
    }
    return $temp->format('Y-m-d H:i:s');
  }

  public static function ISO(string $datetime = null)
  {
    if (!$datetime) {
      return null;
    }

    $temp = new DateTime($datetime);
    return $temp->format(DateTime::ATOM);
  }
}
