<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\AccountDataTable;
use App\Models\Account;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateAccountRequest;
use App\Http\Requests\Admin\UpdateAccountRequest;
use App\MyClasses\GeneralHelperFunctions;
use App\Repositories\Admin\AccountRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Support\Facades\DB;

class AccountController extends AppBaseController
{
    /** @var  AccountRepository */
    private $accountRepository;

    public function __construct(AccountRepository $accountRepo)
    {
        $this->accountRepository = $accountRepo;
    }

    /**
     * Display a listing of the Account.
     *
     * @param AccountDataTable $accountDataTable
     * @return Response
     */
    public function index(AccountDataTable $accountDataTable)
    {
        return $accountDataTable->render('admin.accounts.index');
    }

    /**
     * Show the form for creating a new Account.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.accounts.create');
    }

    /**
     * Store a newly created Account in storage.
     *
     * @param CreateAccountRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateAccountRequest $request)
    {
        $input = $request->all();

        DB::beginTransaction();
        $account = $this->accountRepository->create($input);
        DB::commit();

        return Response::json(['message' => 'Account has been created successfully.'
                    . GeneralHelperFunctions::getSuccessResponseBtn($account, route('admin.accounts.edit', $account))]);
    }

    /**
     * Display the specified Account.
     *
     * @param  Account $account
     *
     * @return Response
     */
    public function show(Account $account)
    {
        return view('admin.accounts.show')->with('account', $account);
    }

    /**
     * Show the form for editing the specified Account.
     *
     * @param  Account $account
     *
     * @return Response
     */
    public function edit(Account $account)
    {
        return view('admin.accounts.edit')->with('account', $account);
    }

    /**
     * Update the specified Account in storage.
     *
     * @param  Account $account
     * @param UpdateAccountRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Account $account, UpdateAccountRequest $request)
    {
        DB::beginTransaction();
        $account = $this->accountRepository->update($request->all(), $account->id);
        DB::commit();

        return Response::json(['message' => 'Account updated successfully.']);
    }

    /**
     * Remove the specified Account from storage.
     *
     * @param  Account $account
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Account $account)
    {
        $this->accountRepository->delete($account->id);

        return Response::json(['message' => 'Account deleted successfully']);
    }
}
