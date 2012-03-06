<?php

	namespace ServiceLayers;

	class Dummy extends ServiceLayer
	{

		public function __construct()
		{
			echo '<pre>' . print_r(__METHOD__, true) . '</pre>';
		}
	}