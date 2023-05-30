<?php

namespace App\Repositories\Admin;

use App\Models\Account;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

/**
 * Class AccountRepository
 * @package App\Repositories\Admin
 * @version August 30, 2021, 7:43 am UTC
*/

class AccountRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'privacy_policy_url',
        'play_console_url'
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
        return Account::class;
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
