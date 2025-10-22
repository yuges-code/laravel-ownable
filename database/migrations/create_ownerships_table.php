<?php

use Yuges\Package\Enums\KeyType;
use Yuges\Ownable\Config\Config;
use Yuges\Ownable\Models\Ownership;
use Yuges\Package\Database\Schema\Schema;
use Yuges\Package\Database\Schema\Blueprint;
use Yuges\Package\Database\Migrations\Migration;

return new class extends Migration
{
    public function __construct()
    {
        $this->table = Config::getOwnershipClass(Ownership::class)::getTableName();
    }

    public function up(): void
    {
        if (Schema::hasTable($this->table)) {
            return;
        }

        $relations = [
            'owner' => Config::getOwnerRelationName('owner'),
            'ownable' => Config::getOwnableRelationName('ownable'),
        ];

        Schema::create($this->table, function (Blueprint $table) use ($relations) {
            if (Config::getOwnershipKeyHas(true)) {
                $table->key(Config::getOwnershipKeyType(KeyType::BigInteger));
            }

            $table->keyMorphs(
                Config::getOwnerKeyType(KeyType::BigInteger),
                $relations['owner'],
            );

            $table->keyMorphs(
                Config::getOwnableKeyType(KeyType::BigInteger),
                $relations['ownable'],
            );

            $table->order();
            $table->unique([
                $relations['owner'] . '_id',
                $relations['owner'] . '_type',
                $relations['ownable'] . '_id',
                $relations['ownable'] . '_type',
            ]);

            $table->timestamps();
        });
    }
};
