<?php

namespace App\Models;

use App\Contracts\HasRelations;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Country
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Author[] $authors
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Book[] $books
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Language[] $languages
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country newModelQuery()
 * @method \Illuminate\Database\Eloquent\Builder|\App\Models\Country newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $code
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereUpdatedAt($value)
 */
class Country extends Model implements HasRelations
{
    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'countries';

    /**
     * Primary key of the table.
     *
     * @var string
     */
    protected $primaryKey = 'code';

    /**
     * Disable primary key auto-increment.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Set primary key data type.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Fields that should be mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'name',
    ];

    /**
     * Fields that should be hidden in JSON responses.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * Many-To-Many: One country can have many languages.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function languages(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Language::class);
    }

    /**
     * One-To-Many: One country can have many books.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function books(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Book::class);
    }

    /**
     * One-To-Many: One country can have many authors.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function authors(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Author::class);
    }

    /**
     * Get the names of all relations.
     *
     * @return array
     */
    public static function getRelationNames(): array
    {
        return [
            'languages',
            'books',
            'authors',
        ];
    }
}
