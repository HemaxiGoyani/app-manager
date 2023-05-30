<?php

namespace App\Repositories\Admin;

use App\Models\AdditionalSpecificAttribute;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

/**
 * Class AdditionalSpecificAttributeRepository
 * @package App\Repositories\Admin
 * @version September 6, 2021, 12:38 pm IST
*/

class AdditionalSpecificAttributeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'data_type'
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
        return AdditionalSpecificAttribute::class;
    }

    /**
     * request handler for store and update
     * @param Request $request
     * @return array
     */
    public static function requestHandler(Request $request)
    {
        return [];
    }
}
