<?php

namespace Yuges\Ownable\Relations;

use Exception;
use Yuges\Ownable\Interfaces\Ownable;

class MorphToMany extends \Illuminate\Database\Eloquent\Relations\MorphToMany
{
    /**
     * Create a new instance of the related model.
     *
     * @param  array  $attributes
     * @param  array  $joining
     * @param  bool  $touch
     * @return TRelatedModel&object{pivot: TPivotModel}
     */
    public function create(array $attributes = [], array $joining = [], $touch = true)
    {
        $attributes = array_merge($this->getQuery()->pendingAttributes, $attributes);

        $instance = $this->related->newInstance($attributes);

        if (! $instance instanceof Ownable) {
            throw new Exception('Instance must be of the Ownable type');
        }

        $instance->setCreatingRelation($this);

        // Once we save the related model, we need to attach it to the base model via
        // through intermediate table so we'll use the existing "attach" method to
        // accomplish this which will insert the record and any more attributes.
        $instance->save(['touch' => false]);

        $this->attach($instance, $joining, $touch);

        return $instance;
    }
}
