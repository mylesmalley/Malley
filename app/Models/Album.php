<?php

/*
 *
 *
 *
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * App\Models\Album
 *
 * @property int $id
 * @property int $_lft
 * @property int $_rgt
 * @property int|null $parent_id
 * @property string $name
 * @property bool $public
 * @property string|null $search_string
 * @property-read \Kalnoy\Nestedset\Collection|Album[] $children
 * @property-read int|null $children_count
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\App\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read Album|null $parent
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\App\Models\Media[] $photos
 * @property-read int|null $photos_count
 * @property-write mixed $created_at
 * @property-write mixed $updated_at
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\App\Models\Media[] $topphotos
 * @property-read int|null $topphotos_count
 * @method static \Kalnoy\Nestedset\Collection|static[] all($columns = ['*'])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Album ancestorsAndSelf($id, array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Album ancestorsOf($id, array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Album applyNestedSetScope(?string $table = null)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Album countErrors()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Album d()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Album defaultOrder(string $dir = 'asc')
 * @method static \Kalnoy\Nestedset\QueryBuilder|Album descendantsAndSelf($id, array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Album descendantsOf($id, array $columns = [], $andSelf = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Album fixSubtree($root)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Album fixTree($root = null)
 * @method static \Kalnoy\Nestedset\Collection|static[] get($columns = ['*'])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Album getNodeData($id, $required = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Album getPlainNodeData($id, $required = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Album getTotalErrors()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Album hasChildren()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Album hasParent()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Album isBroken()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Album leaves(array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Album makeGap(int $cut, int $height)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Album moveNode($key, $position)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Album newModelQuery()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Album newQuery()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Album orWhereAncestorOf(bool $id, bool $andSelf = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Album orWhereDescendantOf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Album orWhereNodeBetween($values)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Album orWhereNotDescendantOf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Album query()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Album rebuildSubtree($root, array $data, $delete = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Album rebuildTree(array $data, $delete = false, $root = null)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Album reversed()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Album root(array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Album whereAncestorOf($id, $andSelf = false, $boolean = 'and')
 * @method static \Kalnoy\Nestedset\QueryBuilder|Album whereAncestorOrSelf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Album whereDescendantOf($id, $boolean = 'and', $not = false, $andSelf = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Album whereDescendantOrSelf(string $id, string $boolean = 'and', string $not = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Album whereId($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Album whereIsAfter($id, $boolean = 'and')
 * @method static \Kalnoy\Nestedset\QueryBuilder|Album whereIsBefore($id, $boolean = 'and')
 * @method static \Kalnoy\Nestedset\QueryBuilder|Album whereIsLeaf()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Album whereIsRoot()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Album whereLft($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Album whereName($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Album whereNodeBetween($values, $boolean = 'and', $not = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Album whereNotDescendantOf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Album whereParentId($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Album wherePublic($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Album whereRgt($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Album whereSearchString($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Album withDepth(string $as = 'depth')
 * @method static \Kalnoy\Nestedset\QueryBuilder|Album withoutRoot()
 * @mixin \Eloquent
 */
class Album extends BaseModel implements HasMedia
{
	use NodeTrait;
    use InteractsWithMedia;

	/**
	 * @var bool
	 */
	public $timestamps = false;

	/**
	 * @var string
	 */
	public $table = "albums";

	/**
	 * @var array
	 */
	protected $fillable = [
		'name',
		"public",
        'search_string'
	];

//	    public function setNameAttribute( string $name )
//    {
//        $this->attributes['name'] = $this->cleanName( $name );
//    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(368)
            ->height(232)
            ->sharpen(10);
    }

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function photos()
	{
		return $this->hasMany('App\Models\Media');
	}


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function topphotos()
    {
        return $this->hasMany('App\Models\Media', 'model_id','id')->limit(6);
    }


//
//	private function cleanName( string $name ) : string
//	{
//		return str_replace([' ','_'],'-', $name );
//
//	}

	/**
	 * @return string
	 */
	public function mediaUrl(): string
	{
		return "https://blueprint.malleyindustries.com/media/" . $this->id;
	}


//	public function setFileNameAttribute( string $name )
//	{
//		$this->attributes['file_name'] = $this->cleanName( $name );
//	}
}
