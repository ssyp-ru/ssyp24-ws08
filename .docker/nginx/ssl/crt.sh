#!/bin/bash
DOMAIN="*.local"
#if [ ! $# -eq 1 ]; then echo 'ERROR: use crt.sh domain'; exit 1; fi

FILENAME=$(echo "${DOMAIN//[^[:alnum:]]/_}" | sed 's/^_*//')

# Create the certificate key
openssl genrsa -out $FILENAME.key 2048

# Create the signing (csr)
openssl req -new -sha256 -key $FILENAME.key \
-subj "/C=HU/ST=Budapest/L=Budapest/O=ACME/OU=ACME Inc/emailAddress=mail@local/CN=$DOMAIN" \
-config <(cat /etc/ssl/openssl.cnf) \
-out $FILENAME.csr

# Verify the csr's content
openssl req -in $FILENAME.csr -noout -text

# Generate the certificate using the csr and key along with the CA Root key
openssl x509 -req -in $FILENAME.csr -CA rootCA.crt -CAkey rootCA.key -CAcreateserial -days 500 -sha256 -extfile v3.ext -out $FILENAME.crt

# Verify the certificate's content
openssl x509 -in $FILENAME.crt -text -noout
