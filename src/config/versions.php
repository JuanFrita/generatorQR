<?php

/**
 * -- Description:
 * Column 1 Error correction level
 * Column 2 - 5 Max length for a combination of encoding, version and error correction level
 * Column 6 Suported version for the other row features
 */

return [
    #ERROR CORRECTION LEVEL     NUMERIC     ALPHANUMERIC    LATIN1      KANJI       VERSION
    # -- Version 1
    ["L",                       41,         25,             17,         10,         1],
    ["M",                       34,         20,             14,         8,          1],
    ["Q",                       27,         16,             11,         7,          1],
    ["H",                       17,         10,             7,          4,          1],
    # -- Version 2
    ["L",                   	77,        	47,         	32,     	20,         2],
    ["M",                   	63,        	38,         	26,     	16,         2],
    ["Q",                   	48,        	29,         	20,     	12,         2],
    ["H",                   	34,        	20,         	14,     	8,          2],
    # -- Version 3
    
];
