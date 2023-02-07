# TODO LIST HEXA

## Authentification
Use of [LexikJWTAuthenticationBundle](https://symfony.com/bundles/LexikJWTAuthenticationBundle/current/index.html)

### ☝️ Key pair generation in Windows
    mkdir -p config/jwt

    openssl genpkey -out config/jwt/private.pem -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096

    openssl pkey -in config/jwt/private.pem -out config/jwt/public.pem -pubout
