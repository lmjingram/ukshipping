# Postcode Coding Exercise
Your task is to write a php class and basic frontend that accepts a string which should be a UK postcode.
You need to return the postcode formatted correctly if it's valid and idendity which delivery services can be offered to that postcode.

The restrictions are as follows :-

## Postcodes that we can't offer a delivery service to
* BT
* GY
* HS
* IM
* JE
* KW
* ZE
* PH
* PO30 - PO41
* IV1
* IV4

## Postcodes that we can't offer a Weekend delivery service to
* DD
* IV2
* IV5
* IV12 - IV13
* IV31
* IV36
* KY
* TF
* WC
* PA
* PH1 - PH32
* IV30 - IV32

## Postcodes that we can't offer a Sunday delivery service to
* CO
* CR
* DG
* DY
* EC
* GU
* LA
* LD
* LL
* NR
* NW
* PE
* PL
* PO
* SA
* SL
* SO
* SP
* SS
* TW
* UB
* WR
* WS
* YO

All other postcodes should be offered a standard Monday to Friday service and also Weekend service.
