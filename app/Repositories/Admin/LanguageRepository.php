<?php

namespace App\Repositories\Admin;

use App\Models\Language;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

/**
 * Class LanguageRepository
 * @package App\Repositories\Admin
 * @version September 3, 2021, 11:38 am IST
*/

class LanguageRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'order'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Language::class;
    }

    /**
     * request handler for store and update
     * @param Request $request
     * @return array
     */
    public static function requestHandler(Request $request)
    {
        return [
            'order' => $request->input('order') ?? 0,
        ];
    }
}
