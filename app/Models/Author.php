<?php

namespace App\Models;

use App\Contracts\HasRelations;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Author
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Book[] $books
 * @property-read \App\Models\Country $country
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Author newModelQuery()
 * @method \Illuminate\Database\Eloquent\Builder|\App\Models\Author newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Author query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $last_name
 * @property string $first_name
 * @property string|null $date_of_birth
 * @property string|null $homepage
 * @property string|null $country_code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Author whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Author whereDateOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Author whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Author whereHomepage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Author whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Author whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Author whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Author whereCountryCode($value)
 */
class Author extends Model implements HasRelations
{
    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'authors';

    /**
     * Fields that should be mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'last_name',
        'first_name',
        'date_of_birth',
        'homepage',
        'country_code',
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'date_of_birth' => 'date',
    ];

    /**
     * One-To-Many: One author can have many books.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function books(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Book::class);
    }

    /**
     * One-To-Many: One author belongs to one country.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Get the names of all relations.
     *
     * @return array
     */
    public static function getRelationNames(): array
    {
        return [
            'books',
            'country',
        ];
    }
}
