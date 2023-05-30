<?php

namespace App\Repositories\Admin;

use App\Models\Account;
use App\Models\Application;
use App\MyClasses\GeneralHelperFunctions;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

/**
 * Class ApplicationRepository
 * @package App\Repositories\Admin
 * @version August 30, 2021, 8:22 am UTC
*/

class ApplicationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'version_count',
        'version',
        'account_fk',
        'package',
        'notification_app_id',
        'notification_server_key',
        'update_title',
        'update_message',
        'status'
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
        return Application::class;
    }

    /**
     * request handler for store and update
     * @param Request $request
     * @return array
     */
    public static function requestHandler(Request $request)
    {
        return [
            'account_fk' => GeneralHelperFunctions::getModelIdFromUuid(Account::query(), $request->input('account_fk')),
        ];
    }
}
