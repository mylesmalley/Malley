<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

/**
 * App\Models\Question
 *
 * @property int $id
 * @property int $_lft
 * @property int $_rgt
 * @property int|null $parent_id
 * @property string $question
 * @property int|null $layout_id
 * @property string|null $category
 * @property bool $visible
 * @property-read \Kalnoy\Nestedset\Collection|Question[] $children
 * @property-read int|null $children_count
 * @property-read \App\Models\Layout|null $layout
 * @property-read Question|null $parent
 * @property-write mixed $created_at
 * @property-write mixed $updated_at
 * @method static \Kalnoy\Nestedset\Collection|static[] all($columns = ['*'])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Question ancestorsAndSelf($id, array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Question ancestorsOf($id, array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Question applyNestedSetScope(?string $table = null)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Question countErrors()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Question d()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Question defaultOrder(string $dir = 'asc')
 * @method static \Kalnoy\Nestedset\QueryBuilder|Question descendantsAndSelf($id, array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Question descendantsOf($id, array $columns = [], $andSelf = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Question fixSubtree($root)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Question fixTree($root = null)
 * @method static \Kalnoy\Nestedset\Collection|static[] get($columns = ['*'])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Question getNodeData($id, $required = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Question getPlainNodeData($id, $required = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Question getTotalErrors()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Question hasChildren()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Question hasParent()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Question isBroken()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Question leaves(array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Question makeGap(int $cut, int $height)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Question moveNode($key, $position)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Question newModelQuery()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Question newQuery()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Question orWhereAncestorOf(bool $id, bool $andSelf = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Question orWhereDescendantOf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Question orWhereNodeBetween($values)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Question orWhereNotDescendantOf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Question query()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Question rebuildSubtree($root, array $data, $delete = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Question rebuildTree(array $data, $delete = false, $root = null)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Question reversed()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Question root(array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Question whereAncestorOf($id, $andSelf = false, $boolean = 'and')
 * @method static \Kalnoy\Nestedset\QueryBuilder|Question whereAncestorOrSelf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Question whereCategory($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Question whereDescendantOf($id, $boolean = 'and', $not = false, $andSelf = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Question whereDescendantOrSelf(string $id, string $boolean = 'and', string $not = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Question whereId($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Question whereIsAfter($id, $boolean = 'and')
 * @method static \Kalnoy\Nestedset\QueryBuilder|Question whereIsBefore($id, $boolean = 'and')
 * @method static \Kalnoy\Nestedset\QueryBuilder|Question whereIsLeaf()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Question whereIsRoot()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Question whereLayoutId($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Question whereLft($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Question whereNodeBetween($values, $boolean = 'and', $not = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Question whereNotDescendantOf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Question whereParentId($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Question whereQuestion($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Question whereRgt($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Question whereVisible($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Question withDepth(string $as = 'depth')
 * @method static \Kalnoy\Nestedset\QueryBuilder|Question withoutRoot()
 * @mixin \Eloquent
 */
class Question extends BaseModel
{
    use NodeTrait;
	
	public $timestamps= false;

	protected $fillable= [
		'question',
        'category',
		'layout_id',
		'visible',
	];

	public function layout()
	{
		return $this->belongsTo('\App\Models\Layout');
	}


}
