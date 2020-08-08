<?php

namespace ExtendedSlim\SsoApp\Repository;

use Exception;
use ExtendedSlim\App\Utils\DateTimeImmutableUtil;
use ExtendedSlim\SsoApp\Entity\SsoUser;
use ExtendedSlim\SsoApp\Exception\SsoUserNotFoundException;
use GuzzleHttp\Exception\GuzzleException;

class SsoRepository extends AbstractSsoApiRepository
{
    /**
     * @param string $authorizationToken
     *
     * @return SsoUser
     *
     * @throws GuzzleException
     * @throws SsoUserNotFoundException
     * @throws Exception
     */
    public function getUserByToken(string $authorizationToken): SsoUser
    {
        try
        {
            $response = $this->getClient()->request('GET',
                'user',
                [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $authorizationToken,
                    ],
                ]
            );
        }
        catch (Exception $e)
        {
            throw new SsoUserNotFoundException();
        }

        return $this->createFactory($response->getData());
    }

    /**
     * @param string $authorizationToken
     * @param int    $userId
     *
     * @return SsoUser
     *
     * @throws GuzzleException
     * @throws SsoUserNotFoundException
     * @throws Exception
     */
    public function getUserByTokenAndUserId(string $authorizationToken, int $userId): SsoUser
    {
        try
        {
            $response = $this->getClient()->request('GET',
                'user/get?uid=' . $userId,
                [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $authorizationToken,
                    ],
                ]
            );
        }
        catch (Exception $e)
        {
            throw new SsoUserNotFoundException();
        }

        return $this->createFactory($response->getData());
    }

    /**
     * @param array $data
     *
     * @return SsoUser
     *
     * @throws Exception
     */
    private function createFactory(array $data): SsoUser
    {
        return new SsoUser(
            $data['id'],
            $data['name'],
            $data['email'],
            new DateTimeImmutableUtil($data['email_verified_at']),
            new DateTimeImmutableUtil($data['created_at']),
            new DateTimeImmutableUtil($data['updated_at'])
        );
    }
}
