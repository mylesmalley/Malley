<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;

/**
 * App\Models\FormElement
 */
class FormElement extends BaseModel
{
    protected $table = 'form_elements';

    protected $fillable = [
        'label',
        'type',
        'form_id',
        'option_id_requirement',
        'indent',
        'position',
    ];


    /**
     * @return BelongsTo
     */
    public function form(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Form::class);
    }

    /**
     * @return HasMany
     */
    public function items(): HasMany
    {
        return $this->hasMany(\App\Models\FormElementItem::class);
    }

    /**
     * @return Collection
     */
    public function itemMedia(): Collection
    {
        $media = [];
        $items = FormElementItem::where('form_element_id', $this->attributes['id'])
            ->orderBy('position')
            ->with('media')
            ->get();

        foreach ($items as $i) {
            $media[] = $i->media;
        }

        return collect($media);
    }

    /**
     * @return HasOne
     */
    public function rule(): HasOne
    {
        return $this->hasOne(\App\Models\FormElementRule::class, 'form_element_id');
    }

    /**
     * @return array
     */
    public function affectedOptions(): array
    {
        $options = [];
        $items = $this->items;
        foreach ($items as $item) {
            $options[] = $item->option->option_name;
        }

        return $options;
    }

    /**
     * @return string
     */
    public function getAffectedOptionsJSONAttribute(): string
    {
        return '["'.implode('","', $this->affectedOptions()).'"]';
    }
}
