<?php

namespace App\Models;

use App\Contracts\HasRelations;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Book
 *
 * @property-read \App\Models\Author $author
 * @property-read \App\Models\Country $country
 * @property-read \App\Models\Language $language
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Book newModelQuery()
 * @method \Illuminate\Database\Eloquent\Builder|\App\Models\Book newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Book query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $publisher
 * @property float $price
 * @property int $author_id
 * @property string $country_code
 * @property string $language_code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Book whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Book whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Book whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Book whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Book wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Book wherePublisher($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Book whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Book whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Book whereCountryCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Book whereLanguageCode($value)
 */
class Book extends Model implements HasRelations
{
    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'books';

    /**
     * Fields that should be mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'publisher',
        'price',
        'author_id',
        'country_code',
        'language_code',
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
     * One-To-Many: One book belongs to one author.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    /**
     * One-To-Many: One book belongs to one country.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * One-To-Many: One book belongs to one language.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function language(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Language::class);
    }

    /**
     * Get the names of all relations.
     *
     * @return array
     */
    public static function getRelationNames(): array
    {
        return [
            'author',
            'country',
            'language',
        ];
    }
}
