<?php

namespace OAuth2\OpenID\Storage;

/**
 * Implement this interface to specify where the OAuth2 Server
 * should retrieve user claims for the OpenID Connect id_token.
 */
interface UserClaimsInterface
{
    // valid scope values to pass into the user claims API call
    const VALID_CLAIMS = 'basic profile email address phone privileges';   //[dnc19] [dnc151a] 

    // fields returned for the claims above
    const PROFILE_CLAIM_VALUES  = 'name family_name given_name middle_name nickname preferred_username profile picture website gender birthdate zoneinfo locale updated_at';
    const EMAIL_CLAIM_VALUES    = 'email email_verified';  //[dnc46]
    //[dnc2]const ADDRESS_CLAIM_VALUES  = 'formatted street_address locality region postal_code country';
    const ADDRESS_CLAIM_VALUES  = 'address street_address locality region postal_code country';  //[dnc2]
    const PHONE_CLAIM_VALUES    = 'phone_number phone_number_verified';
    const PRIVILEGES_CLAIM_VALUES = 'scope profil';  //[dnc19]
    
    const OPENID_CLAIM_VALUES = self::PROFILE_CLAIM_VALUES . ' ' . self::EMAIL_CLAIM_VALUES . ' ' . self::ADDRESS_CLAIM_VALUES . ' ' . self::PHONE_CLAIM_VALUES . ' ' . self::PRIVILEGES_CLAIM_VALUES;   //[dnc2']  //[dnc19]



    /**
     * Return claims about the provided user id.
     *
     * Groups of claims are returned based on the requested scopes. No group
     * is required, and no claim is required.
     *
     * @param mixed  $user_id - The id of the user for which claims should be returned.
     * @param string $scope   - The requested scope.
     * Scopes with matching claims: profile, email, address, phone.
     *
     * @return array - An array in the claim => value format.
     *
     * @see http://openid.net/specs/openid-connect-core-1_0.html#ScopeClaims
     */
    public function getUserClaims($user_id, $scope);
}
