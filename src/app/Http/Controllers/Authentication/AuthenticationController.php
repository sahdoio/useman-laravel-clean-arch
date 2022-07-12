<?php

namespace App\Http\Controllers\Authentication;

use App\Contracts\BaseController;
use App\Http\Controllers\Controller;
use Core\Common\APIResponse;
use Core\Common\Log;
use Core\Domain\UseCases\Authentication\AuthenticationContract;
use Core\Domain\UseCases\Authentication\AuthenticationInputDto;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthenticationController extends Controller implements BaseController
{
    public function __construct(
        private readonly AuthenticationContract $userAuthentication
    ) {}

    public function handle(Request $request): JsonResponse
    {        
        dd($request->all());

        try {
            $validate = Validator::make($request->input(), [
                'email' => 'required|string',
                'username' => 'sometimes|string',
                'password' => 'required|string|min:8',
            ]);

            if ($validate->fails()) {
                Log::error('Invalid parameters');
                return APIResponse::badRequest($validate->getMessageBag()->all());
            }

            $userAuthenticationOutputDto = $this->userAuthentication->exec(new AuthenticationInputDto(
                email: $request->email,
                username: $request->username,
                password: $request->password
            ));

            return APIResponse::success('success', $userAuthenticationOutputDto);
        } catch (Exception $e) {
            Log::error($e);
            return APIResponse::serverError();
        }
    }
}
