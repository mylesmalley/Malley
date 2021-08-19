<?php

namespace App\Models;

use Kalnoy\Nestedset\NodeTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Models\BaseModel;
use \Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Folder
 *
 * @property int $id
 * @property int $_lft
 * @property int $_rgt
 * @property int|null $parent_id
 * @property string $name
 * @property-read \Kalnoy\Nestedset\Collection|Folder[] $children
 * @property-read int|null $children_count
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\App\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read Folder|null $parent
 * @property-write mixed $created_at
 * @property-write mixed $updated_at
 * @method static \Kalnoy\Nestedset\Collection|static[] all($columns = ['*'])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Folder ancestorsAndSelf($id, array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Folder ancestorsOf($id, array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Folder applyNestedSetScope(?string $table = null)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Folder countErrors()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Folder d()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Folder defaultOrder(string $dir = 'asc')
 * @method static \Kalnoy\Nestedset\QueryBuilder|Folder descendantsAndSelf($id, array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Folder descendantsOf($id, array $columns = [], $andSelf = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Folder fixSubtree($root)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Folder fixTree($root = null)
 * @method static \Kalnoy\Nestedset\Collection|static[] get($columns = ['*'])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Folder getNodeData($id, $required = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Folder getPlainNodeData($id, $required = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Folder getTotalErrors()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Folder hasChildren()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Folder hasParent()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Folder isBroken()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Folder leaves(array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Folder makeGap(int $cut, int $height)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Folder moveNode($key, $position)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Folder newModelQuery()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Folder newQuery()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Folder orWhereAncestorOf(bool $id, bool $andSelf = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Folder orWhereDescendantOf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Folder orWhereNodeBetween($values)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Folder orWhereNotDescendantOf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Folder query()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Folder rebuildSubtree($root, array $data, $delete = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Folder rebuildTree(array $data, $delete = false, $root = null)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Folder reversed()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Folder root(array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Folder whereAncestorOf($id, $andSelf = false, $boolean = 'and')
 * @method static \Kalnoy\Nestedset\QueryBuilder|Folder whereAncestorOrSelf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Folder whereDescendantOf($id, $boolean = 'and', $not = false, $andSelf = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Folder whereDescendantOrSelf(string $id, string $boolean = 'and', string $not = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Folder whereId($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Folder whereIsAfter($id, $boolean = 'and')
 * @method static \Kalnoy\Nestedset\QueryBuilder|Folder whereIsBefore($id, $boolean = 'and')
 * @method static \Kalnoy\Nestedset\QueryBuilder|Folder whereIsLeaf()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Folder whereIsRoot()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Folder whereLft($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Folder whereName($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Folder whereNodeBetween($values, $boolean = 'and', $not = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Folder whereNotDescendantOf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Folder whereParentId($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Folder whereRgt($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Folder withDepth(string $as = 'depth')
 * @method static \Kalnoy\Nestedset\QueryBuilder|Folder withoutRoot()
 * @mixin \Eloquent
 */
class Folder extends BaseModel implements HasMedia
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
    public $table = "folders";


    /**
     * @var string[]
     */
    public $fillable = [
        "name"
    ];


}
