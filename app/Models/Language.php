<?php

namespace App\Models;

use App\Contracts\HasRelations;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Language
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Book[] $books
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Country[] $countries
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language newModelQuery()
 * @method \Illuminate\Database\Eloquent\Builder|\App\Models\Language newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $code
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language whereUpdatedAt($value)
 */
class Language extends Model implements HasRelations
{
    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'languages';

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
     * Many-To-Many: One language can belong to many countries.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function countries(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Country::class);
    }

    /**
     * One-To-Many: One language can have many books.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function books(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Book::class);
    }

    /**
     * Get the names of all relations.
     *
     * @return array
     */
    public static function getRelationNames(): array
    {
        return [
            'countries',
            'books',
        ];
    }
}
