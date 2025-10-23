<?php

namespace Yuges\Ownable\Config;

use Yuges\Package\Enums\KeyType;
use Illuminate\Support\Collection;
use Yuges\Ownable\Models\Ownership;
use Yuges\Ownable\Interfaces\Owner;
use Yuges\Ownable\Interfaces\Ownable;
use Yuges\Ownable\Observers\OwnerObserver;
use Yuges\Ownable\Actions\SyncOwnersAction;
use Yuges\Ownable\Observers\OwnableObserver;
use Yuges\Ownable\Actions\AttachOwnersAction;
use Yuges\Ownable\Actions\DetachOwnersAction;
use Yuges\Ownable\Observers\OwnershipObserver;

class Config extends \Yuges\Package\Config\Config
{
    const string NAME = 'ownable';

    public static function getOwnerKeyHas(mixed $default = null): bool
    {
        return self::get('models.owner.key.has', $default);
    }

    public static function getOwnerKeyType(mixed $default = null): KeyType
    {
        return self::get('models.owner.key.type', $default);
    }

    /** @return class-string<Owner> */
    public static function getOwnerDefaultClass(mixed $default = null): string
    {
        return self::get('models.owner.default.class', $default);
    }

    /** @return Collection<array-key, class-string<Owner>> */
    public static function getOwnerAllowedClasses(mixed $default = null): Collection
    {
        return Collection::make(
            self::get('models.owner.allowed.classes', $default)
        );
    }

    public static function getOwnerRelationName(mixed $default = null): string
    {
        return self::get('models.owner.relation.name', $default);
    }

    /** @return class-string<OwnerObserver> */
    public static function getOwnerObserverClass(mixed $default = null): string
    {
        return self::get('models.owner.observer', $default);
    }

    public static function getOwnableKeyHas(mixed $default = null): bool
    {
        return self::get('models.ownable.key.has', $default);
    }

    public static function getOwnableKeyType(mixed $default = null): KeyType
    {
        return self::get('models.ownable.key.type', $default);
    }

    /** @return Collection<array-key, class-string<Ownable>> */
    public static function getOwnableAllowedClasses(mixed $default = null): Collection
    {
        return Collection::make(
            self::get('models.ownable.allowed.classes', $default)
        );
    }

    public static function getOwnableRelationName(mixed $default = null): string
    {
        return self::get('models.ownable.relation.name', $default);
    }

    /** @return class-string<OwnableObserver> */
    public static function getOwnableObserverClass(mixed $default = null): string
    {
        return self::get('models.ownable.observer', $default);
    }

    public static function getOwnershipKeyHas(mixed $default = null): bool
    {
        return self::get('models.ownership.key.has', $default);
    }

    public static function getOwnershipKeyType(mixed $default = null): KeyType
    {
        return self::get('models.ownership.key.type', $default);
    }

    public static function getOwnershipTable(mixed $default = null): string
    {
        return self::get('models.ownership.table', $default);
    }

    /** @return class-string<Ownership> */
    public static function getOwnershipClass(mixed $default = null): string
    {
        return self::get('models.ownership.class', $default);
    }

    public static function getOwnershipRelationName(mixed $default = null): string
    {
        return self::get('models.ownership.relation.name', $default);
    }

    /** @return class-string<OwnershipObserver> */
    public static function getOwnershipObserverClass(mixed $default = null): string
    {
        return self::get('models.ownership.observer', $default);
    }

    public static function getPermissionsOwnAuto(mixed $default = false): bool
    {
        return self::get('permissions.own.auto', $default);
    }

    public static function getSyncOwnersAction(
        Ownable $ownable,
        mixed $default = null
    ): SyncOwnersAction
    {
        return self::getSyncOwnersActionClass($default)::create($ownable);
    }

    /** @return class-string<SyncOwnersAction> */
    public static function getSyncOwnersActionClass(mixed $default = null): string
    {
        return self::get('actions.sync', $default);
    }

    public static function getAttachOwnersAction(
        Ownable $ownable,
        mixed $default = null
    ): AttachOwnersAction
    {
        return self::getAttachOwnersActionClass($default)::create($ownable);
    }

    /** @return class-string<AttachOwnersAction> */
    public static function getAttachOwnersActionClass(mixed $default = null): string
    {
        return self::get('actions.attach', $default);
    }

    public static function getDetachOwnersAction(
        Ownable $ownable,
        mixed $default = null
    ): DetachOwnersAction
    {
        return self::getDetachOwnersActionClass($default)::create($ownable);
    }

    /** @return class-string<DetachOwnersAction> */
    public static function getDetachOwnersActionClass(mixed $default = null): string
    {
        return self::get('actions.detach', $default);
    }
}
