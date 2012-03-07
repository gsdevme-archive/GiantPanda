<?php

	namespace Libraries;

	class Dummy
	{

		public function myMethod()
		{
			echo 'Shared Library Called:<pre>' . print_r(__METHOD__, true) . '</pre>';
		}
	}