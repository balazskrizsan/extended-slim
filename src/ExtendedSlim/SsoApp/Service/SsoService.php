<?php

namespace ExtendedSlim\SsoApp\Service;

use ExtendedSlim\SsoApp\Entity\SsoUser;
use ExtendedSlim\SsoApp\Exception\SsoUserNotFoundException;
use ExtendedSlim\SsoApp\Repository\SsoRepository;
use GuzzleHttp\Exception\GuzzleException;

class SsoService
{
    /** @var SsoRepository */
    private $ssoRepository;

    /**
     * @param SsoRepository $ssoRepository
     */
    public function __construct(SsoRepository $ssoRepository)
    {
        $this->ssoRepository = $ssoRepository;
    }

    /**
     * @param string $authorizationToken
     *
     * @return SsoUser
     *
     * @throws GuzzleException
     * @throws SsoUserNotFoundException
     */
    public function getUserByToken(string $authorizationToken): SsoUser
    {
        return $this->ssoRepository->getUserByToken($authorizationToken);
    }

    /**
     * @param string $authorizationToken
     * @param int    $userId
     *
     * @return SsoUser
     *
     * @throws GuzzleException
     * @throws SsoUserNotFoundException
     */
    public function getUserByTokenAndUserId(string $authorizationToken, int $userId): SsoUser
    {
        return $this->ssoRepository->getUserByTokenAndUserId($authorizationToken, $userId);
    }

    /**
     * @param string $authorizationToken
     *
     * @return bool
     *
     * @throws GuzzleException
     */
    public function isValidToken(string $authorizationToken): bool
    {
        try
        {
            if ($this->getUserByToken($authorizationToken) instanceof SsoUser)
            {
                return true;
            }
        }
        catch (SsoUserNotFoundException $e)
        {
            return false;
        }

        return false;
    }
}
