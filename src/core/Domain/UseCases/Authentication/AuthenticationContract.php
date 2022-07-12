<?php

namespace Core\Domain\UseCases\Authentication;

interface AuthenticationContract
{
    public function exec(AuthenticationInputDto $inputData): AuthenticationOutputDto;
}
