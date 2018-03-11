#!/usr/bin/env bash

# 生成以太坊钱包

key=/tmp/key

openssl ecparam -name secp256k1 -genkey -noout | openssl ec -text -noout > $key 2>/dev/null

pub=$(cat $key | grep pub -A 5 | tail -n +2 | tr -d '\n: ' | sed 's/^06//')
pri=$(cat $key | grep priv -A 3 | tail -n +2 | tr -d '\n: ' | sed 's/^00//')
add=$(echo $pub | keccak-256sum -x -l | tr -d ' -' | tail -c 41)

echo -n $add $pri
