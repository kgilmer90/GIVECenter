<?php

class FileReadMode
{
	//TEXT MODE
	const RO_TEXT = 'rt';		//read-only, from beginning, must exist
	
	//BINARY MODE
	const RO_BIN = 'rb';		//read-only, from beginning, must exist
}

class FileWriteMode
{
	//TEXT MODE
	const WO_TRUNC_TEXT = 'wt';		//write-only, truncate to zero if exists, create if doesn't exist
	const WO_APPEND_TEXT = 'at';	//write-only, file pointer set to EOF, create if doesn't exist
	const WO_CREATE_TEXT = 'xt';	//write-only, create if doesn't exist, fail if does exist
	const WO_NOTRUNC_TEXT = 'ct';	//write-only, create if doesn't exist, don't truncate if does exist
	
	//BINARY MODE
	const WO_TRUNC_BIN = 'wb';		//write-only, truncate to zero if exists, create if doesn't exist
	const WO_APPEND_BIN = 'ab';		//write-only, file pointer set to EOF, create if doesn't exist
	const WO_CREATE_BIN = 'xb';		//write-only, create if doesn't exist, fail if does exist
	const WO_NOTRUNC_BIN = 'cb';	//write-only, create if doesn't exist, don't truncate if does exist
}

class FileReadWriteMode
{
	//TEXT MODE
	const RW_TEXT = 'r+t';			//read-write, read from beginning, file must exist
	const RW_TRUNC_TEXT = 'w+t';	//read-write, truncate to zero if exists, create if doesn't exist
	const RW_APPEND_TEXT = 'a+t';	//read-write, file pointer set to EOF, create if doesn't exist
	const RW_CREATE_TEXT = 'x+t';	//read-write, create if doesn't exist, fail if does exist
	const RW_NOTRUNC_TEXT = 'c+t';	//read-write, create if doesn't exist, don't truncate if does exist
	
	//BINARY MODE
	const RW_BIN = 'r+b';			//read-write, read from beginning, file must exist
	const RW_TRUNC_BIN = 'w+b';	//read-write, truncate to zero if exists, create if doesn't exist
	const RW_APPEND_BIN = 'a+b';	//read-write, file pointer set to EOF, create if doesn't exist
	const RW_CREATE_BIN = 'x+b';	//read-write, create if doesn't exist, fail if does exist
	const RW_NOTRUNC_BIN = 'c+b';	//read-write, create if doesn't exist, don't truncate if does exist
}

?>