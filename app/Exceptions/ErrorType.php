<?php

namespace App\Exceptions;

use Exception;

class ErrorType
{
    public const UNKNOWN = 'UNKNOWN';
    public const INPUT_VALIDATION = 'INPUT_VALIDATION';
    public const UNAUTHORIZED = 'UNAUTHORIZED';
    public const EMAIL_NOT_VERIFIED = 'EMAIL_NOT_VERIFIED';
    public const TOKEN_INVALID = 'TOKEN_INVALID';
    public const TOKEN_EXPIRED = 'TOKEN_EXPIRED';
    public const CANNOT_ASSIGN = 'CANNOT_ASSIGN';
    public const CANNOT_EDIT = 'CANNOT_EDIT';
    public const CANNOT_DELETE = 'CANNOT_DELETE';
    public const ITEM_NOT_FOUND = 'ITEM_NOT_FOUND';
    public const ITEMS_NOT_FOUND = 'ITEMS_NOT_FOUND';
    public const FILE_NOT_FOUND = 'FILE_NOT_FOUND';
    public const ITEM_IS_PENDING = 'ITEM_IS_PENDING';
    public const ITEM_IS_OPENED = 'ITEM_IS_OPENED';
    public const ITEM_NOT_OPENED = 'ITEM_NOT_OPENED';
    public const UNAUTHENTICATED = 'UNAUTHENTICATED';
    public const ROUTE_NOT_FOUND = 'ROUTE_NOT_FOUND';
    public const ITEM_NOT_ACTIVE = 'ITEM_NOT_ACTIVE';
    public const ITEM_IS_BLOCKED = 'ITEM_IS_BLOCKED';
    public const ITEMS_NOT_ACTIVE = 'ITEMS_NOT_ACTIVE';
    public const ITEM_IS_CONFIRMED = 'ITEM_IS_CONFIRMED';
    public const INTERNAL_ERROR = 'INTERNAL_ERROR';
    public const ITEM_NOT_CONFIRMED = 'ITEM_NOT_CONFIRMED';
    public const ITEM_NOT_AVAILABLE = 'ITEM_NOT_AVAILABLE';
    public const TOKEN_NOT_PROVIDED = 'TOKEN_NOT_PROVIDED';
    public const ITEMS_HAS_RELATION = 'ITEMS_HAS_RELATION';
    public const ITEMS_HAS_NO_RELATION = 'ITEMS_HAS_NO_RELATION';
    public const METHOD_NOT_ALLOWED = 'METHOD_NOT_ALLOWED';
    public const ITEM_HAS_MAX_RELATION = 'ITEM_HAS_MAX_RELATION';
    public const ITEM_HAS_MIN_RELATION = 'ITEM_HAS_MIN_RELATION';
    public const ITEM_IS_OBLIGATORY = 'ITEM_IS_OBLIGATORY';
    public const ITEMS_ARE_OBLIGATORY = 'ITEMS_ARE_OBLIGATORY';
    public const ITEM_IS_CANCELLED = 'ITEM_IS_CANCELLED';
    public const ITEM_NOT_CANCELLED = 'ITEM_NOT_CANCELLED';
    public const ITEM_NOT_PAID = 'ITEM_NOT_PAID';
    public const ITEM_IS_PAID = 'ITEM_IS_PAID';
    public const ITEM_IS_PARTIALLY_PAID = 'ITEM_IS_PARTIALLY_PAID';
    public const ITEM_INVALID = 'ITEM_INVALID';
    public const RELATION_INVALID = 'RELATION_INVALID';
    public const ITEM_ALREADY_SUBMITTED = 'ITEM_ALREADY_SUBMITTED';

    private const MAP = [
        401 => [
            self::TOKEN_INVALID => 'Token invalid!',
            self::TOKEN_EXPIRED => 'Token expired!',
            self::ITEM_IS_PENDING => 'Item is pending',
            self::EMAIL_NOT_VERIFIED => 'Email not verified',
            self::UNAUTHENTICATED => 'Authentication failed!',
            self::TOKEN_NOT_PROVIDED => 'Token not provided!',
            self::ITEM_IS_BLOCKED => 'Item is blocked',
        ],
        403 => [
            self::UNAUTHORIZED => 'Authorization failed!',
        ],
        404 => [
            self::ITEM_NOT_FOUND => 'The item requested is not found',
            self::FILE_NOT_FOUND => 'The file requested is not found',
            self::ROUTE_NOT_FOUND => 'The route requested does not exist',
        ],
        405 => [
            self::METHOD_NOT_ALLOWED => 'This method is not allowed for this route',
        ],
        422 => [
            self::INPUT_VALIDATION => 'Validation failed!',
            self::CANNOT_ASSIGN => 'Item can not be assigned',
            self::CANNOT_EDIT => 'Item can not be edited',
            self::CANNOT_DELETE => 'Item can not be deleted',
            self::ITEM_IS_OPENED => 'Item status is opened',
            self::ITEM_NOT_OPENED => 'Item status is not opened',
            self::ITEM_NOT_ACTIVE => 'Item is not active',
            self::ITEMS_NOT_ACTIVE => 'Items are not active',
            self::ITEM_IS_CONFIRMED => 'Item status is already confirmed',
            self::ITEM_NOT_CONFIRMED => 'Item status is not confirmed',
            self::ITEM_NOT_AVAILABLE => 'Item is not available',
            self::ITEMS_HAS_RELATION => 'Item has relation with another items',
            self::ITEMS_HAS_NO_RELATION => 'Item has no relation with another items',
            self::ITEM_HAS_MAX_RELATION => 'Item has max limt of relation',
            self::ITEM_HAS_MIN_RELATION => 'Item has min limt of relation',
            self::ITEM_IS_OBLIGATORY => 'Item is obligatory',
            self::ITEMS_ARE_OBLIGATORY => 'Items are obligatory',
            self::ITEM_IS_CANCELLED => 'Item is cancelled',
            self::ITEM_NOT_CANCELLED => 'Item is not cancelled',
            self::ITEM_NOT_PAID => 'Item not paid',
            self::ITEM_IS_PAID => 'Item is paid',
            self::ITEM_IS_PARTIALLY_PAID => 'Item is partially paid',
            self::ITEM_INVALID => 'Item is invalid',
            self::RELATION_INVALID => "Relation are invalid",
            self::ITEMS_NOT_FOUND => 'The items requested are not found',
            self::ITEM_ALREADY_SUBMITTED => 'You already Submitted on this challenge before.'
        ],
        520 => [
            self::UNKNOWN => 'Unknown exception',
            self::INTERNAL_ERROR => 'Internal error',
        ],
    ];

    /**
     * @return string
     */
    public static function title(string $type)
    {
        return self::get($type)['title'];
    }

    /**
     * @return int
     */
    public static function status(string $type)
    {
        return self::get($type)['status'];
    }

    /**
     * @return array
     */
    private static function get(string $type)
    {
        foreach (self::MAP as $status => $types) {
            if (array_key_exists($type, $types)) {
                return [
                    'status' => $status,
                    'title' => $types[$type]
                ];
            }
        }
        throw new Exception('Error Type (' . $type . ') doesn\'t exist');
    }
}
