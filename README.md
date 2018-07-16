Test task solution.
Since I was not limited by any language, I used PHP (PHPUnit + PHPGuzzle).

testWrongLogin() function tests wrong login JSON responce to be correct.
I presumed that in the future we will need to pass more wrong credentials to test corner cases(empty ones, very long etc.), so I created data provider for testWrongLogin() function.