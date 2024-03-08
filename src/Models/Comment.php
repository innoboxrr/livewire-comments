<?php

namespace Innoboxrr\LivewireComments\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Innoboxrr\Traits\MetaOperations;
use Innoboxrr\LivewireComments\Models\Traits\Relations\CommentRelations;
use Innoboxrr\LivewireComments\Models\Traits\Storage\CommentStorage;
use Innoboxrr\LivewireComments\Models\Traits\Assignments\CommentAssignment;
use Innoboxrr\LivewireComments\Models\Traits\Operations\CommentOperations;
use Innoboxrr\LivewireComments\Models\Traits\Mutators\CommentMutators;

class Comment extends Model
{

    use HasFactory,
        SoftDeletes,
        MetaOperations,
        CommentRelations,
        CommentStorage,
        CommentAssignment,
        CommentOperations,
        CommentMutators;
        
    protected $fillable = [];

    protected $creatable = [];

    protected $updatable = [];

    protected $casts = [];

    protected $protected_metas = [];

    protected $editable_metas = [];

    public static $export_cols = [];

    public static $loadable_relations = [];

    public static $loadable_counts = [];

    /*
    protected static function newFactory()
    {
        return \Innoboxrr\LivewireComments\Database\Factories\CommentFactory::new();
    }
    */

}
